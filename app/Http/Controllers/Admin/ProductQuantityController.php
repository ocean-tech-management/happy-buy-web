<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductQuantityRequest;
use App\Http\Requests\StoreProductQuantityRequest;
use App\Http\Requests\UpdateProductQuantityRequest;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\ProductQuantity;
use App\Models\ProductVariant;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductQuantityController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_quantity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $request->request->add(['batch_id' => request('batch_id')]);
            $query = ProductQuantity::with(['batch', 'product', 'product_variant', 'order_item', 'sold_to_user'])->search($request)->select(sprintf('%s.*', (new ProductQuantity())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_quantity_show';
                $editGate = 'product_quantity_edit';
                $deleteGate = 'product_quantity_delete';
                $inStockGate = 'product_quantity_in_stock';
                $generateQrGate = 'product_quantity_generate_qr';
                $damageGate = 'product_quantity_damage';
                $crudRoutePart = 'product-quantities';

                return view('partials.datatablesActions_ProductQuantity', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'inStockGate',
                    'generateQrGate',
                    'damageGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('batch_name', function ($row) {
                return $row->batch ? $row->batch->name : '';
            });

            $table->addColumn('product_name_en', function ($row) {
                return $row->product ? $row->product->name_en : '';
            });

            $table->addColumn('product_variant_sku', function ($row) {
                return $row->product_variant ? $row->product_variant->sku : '';
            });

            $table->addColumn('order_item_product_name_en', function ($row) {
                return $row->order_item ? $row->order_item->product_name_en : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? ProductQuantity::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('sold_to_user_name', function ($row) {
                return $row->sold_to_user ? $row->sold_to_user->name : '';
            });

            $table->editColumn('qr_code', function ($row) {
                return $row->qr_code ? $row->qr_code : '';
            });

            $table->editColumn('first_scan_at', function ($row) {
                return $row->first_scan_at ? $row->first_scan_at : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'batch', 'product', 'product_variant', 'order_item', 'sold_to_user']);

            return $table->make(true);
        }

        return view('admin.productQuantities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_quantity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = ProductBatch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_items = OrderItem::pluck('product_name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sold_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productQuantities.create', compact('batches', 'products', 'product_variants', 'order_items', 'sold_to_users'));
    }

    public function store(StoreProductQuantityRequest $request)
    {
        $productQuantity = ProductQuantity::create($request->all());

        return redirect()->route('admin.product-quantities.index');
    }

    public function edit(ProductQuantity $productQuantity)
    {
        abort_if(Gate::denies('product_quantity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = ProductBatch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_items = OrderItem::pluck('product_name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sold_to_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productQuantity->load('batch', 'product', 'product_variant', 'order_item', 'sold_to_user');

        return view('admin.productQuantities.edit', compact('batches', 'products', 'product_variants', 'order_items', 'sold_to_users', 'productQuantity'));
    }

    public function update(UpdateProductQuantityRequest $request, ProductQuantity $productQuantity)
    {
        $productQuantity->update($request->all());

        return redirect()->route('admin.product-quantities.index');
    }

    public function show(ProductQuantity $productQuantity)
    {
        abort_if(Gate::denies('product_quantity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productQuantity->load('batch', 'product', 'product_variant', 'order_item', 'sold_to_user');

        return view('admin.productQuantities.show', compact('productQuantity'));
    }

    public function destroy(ProductQuantity $productQuantity)
    {
        abort_if(Gate::denies('product_quantity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productQuantity->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductQuantityRequest $request)
    {
        ProductQuantity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function inStock(Request $request)
    {

        $productQuantity = ProductQuantity::findOrFail(request('id'));

        if($productQuantity->status == 1){
            $productBatch = $productQuantity->batch;

            $productQuantity->update([
                'status' => 2,
                'in_stock_at' => Carbon::now(),
                'in_stock_by_id' => Auth::guard('admin')->user()->id
            ]);

            $pendingQuantity = ProductQuantity::whereBatchId($productBatch->id)->whereStatus(1)->count();

            if($pendingQuantity == 0){
                $productBatch->update([
                    'status' => 2,
                    'in_stock_at' => Carbon::now(),
                ]);
            }
        }


        return back();
    }

    public function generateQrPdf(Request $request)
    {
        abort_if(Gate::denies('product_quantity_generate_qr'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productQuantity = ProductQuantity::findOrFail(request('id'));

        $pdf = PDF::loadView('admin.productBatches.qr_single', ['item' => $productQuantity]);
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('page-width', '35');
        $pdf->setOption('page-height', '25');
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline();
    }

    public function confirmDamage(Request $request)
    {
        $remark = $request->remark;

        $productQuantity = ProductQuantity::findOrFail(request('id'));

        $productQuantity->update([
            'status' => 6,
            'remark' => $remark
        ]);

        return back();
    }

    public function confirmFree(Request $request)
    {

        $productQuantity = ProductQuantity::findOrFail(request('id'));

        $productQuantity->update([
            'status' => 7,
        ]);

        return back();
    }

    public function confirmSample(Request $request)
    {

        $productQuantity = ProductQuantity::findOrFail(request('id'));

        $productQuantity->update([
            'status' => 8,
        ]);

        return back();
    }
}
