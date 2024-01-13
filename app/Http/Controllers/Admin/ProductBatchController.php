<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductBatchRequest;
use App\Http\Requests\StoreProductBatchRequest;
use App\Http\Requests\UpdateProductBatchRequest;
use App\Jobs\GenerateProductQuantity;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\ProductQuantity;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductBatchController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_batch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductBatch::with(['product', 'product_variant'])->search($request)->select(sprintf('%s.*', (new ProductBatch())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_batch_show';
                $editGate = 'product_batch_edit';
                $deleteGate = 'product_batch_delete';
                $inStockGate = 'product_batch_in_stock';
                $generateQrGate = 'product_batch_generate_qr';
                $crudRoutePart = 'product-batches';

                return view('partials.datatablesActions_ProductBatch', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'inStockGate',
                    'generateQrGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ProductBatch::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('product_name_en', function ($row) {
                return $row->product ? $row->product->name_en : '';
            });

            $table->addColumn('product_variant_sku', function ($row) {
                return $row->product_variant ? trans('global.color').": ".$row->product_variant->color->name." ".trans('global.size').": ".$row->product_variant->size->name."<br/>".trans('global.sku').": ".$row->product_variant->sku : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });

            $table->editColumn('cost_price', function ($row) {
                return $row->cost_price ? $row->cost_price : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'product_variant', 'product_variant_sku']);

            return $table->make(true);
        }

        return view('admin.productBatches.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_batch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_variants = ProductVariant::orderBy('color_id', 'asc')->orderBy('size_id', 'asc')->get();

        return view('admin.productBatches.create', compact('products', 'product_variants'));
    }

    public function store(StoreProductBatchRequest $request)
    {
        $productVariants = ProductVariant::findOrFail(request('product_variant_id'));

        $request->request->add(['product_id' => $productVariants->product->id]);
        $request->request->add(['created_by_id' => Auth::guard('admin')->user()->id]);

        $productBatch = ProductBatch::create($request->all());

        GenerateProductQuantity::dispatch($productBatch->id, $productVariants->product->id, $productVariants->id, $productBatch->quantity, $productVariants->color_id, $productVariants->size_id, $productBatch->cost_price)->onQueue('product-batch');

        return redirect()->route('admin.product-batches.index');
    }

    public function edit(ProductBatch $productBatch)
    {
        abort_if(Gate::denies('product_batch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productBatch->load('product', 'product_variant');

        return view('admin.productBatches.edit', compact('products', 'product_variants', 'productBatch'));
    }

    public function update(UpdateProductBatchRequest $request, ProductBatch $productBatch)
    {
        $productBatch->update($request->all());

        return redirect()->route('admin.product-batches.index');
    }

    public function show(ProductBatch $productBatch)
    {
        abort_if(Gate::denies('product_batch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBatch->load('product', 'product_variant');

        return view('admin.productBatches.show', compact('productBatch'));
    }

    public function destroy(ProductBatch $productBatch)
    {
        abort_if(Gate::denies('product_batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $productBatch->delete();
        ProductQuantity::whereBatchId($productBatch->id)->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductBatchRequest $request)
    {
        ProductBatch::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function inStock(Request $request)
    {
        $productBatch = ProductBatch::findOrFail(request('id'));

        if ($productBatch->status == 1){
            $productBatch->update([
                'status' => 2,
                'in_stock_at' => Carbon::now(),
                'in_stock_by_id' => Auth::guard('admin')->user()->id
            ]);

            if ($productBatch){
                ProductQuantity::whereBatchId($productBatch->id)->whereStatus(1)->update([
                    'status' => 2,
                    'in_stock_at' => Carbon::now()
                ]);
            }
        }

        return back();

    }

    public function generateQrPdf(Request $request)
    {
        abort_if(Gate::denies('product_batch_generate_qr'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBatch = ProductBatch::findOrFail(request('id'));

        $productQuantity = ProductQuantity::whereBatchId($productBatch->id)->get();

        $pdf = PDF::loadView('admin.productBatches.qr', ['pages' => $productQuantity, 'productBatch' => $productBatch]);
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('page-width', '35');
        $pdf->setOption('page-height', '25');
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($productBatch->name.".pdf");
    }
}
