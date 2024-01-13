<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductSizeRequest;
use App\Http\Requests\StoreProductSizeRequest;
use App\Http\Requests\UpdateProductSizeRequest;
use App\Models\ProductSize;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductSizeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_size_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductSize::query()->select(sprintf('%s.*', (new ProductSize())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_size_show';
                $editGate = 'product_size_edit';
                $deleteGate = 'product_size_delete';
                $statusChangeGate = 'product_size_status_change';
                $crudRoutePart = 'product-sizes';

                return view('partials.datatablesActions_ProductSize', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'statusChangeGate',
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
            $table->editColumn('status', function ($row) {
                return $row->status ? ProductSize::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.productSizes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_size_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productSizes.create');
    }

    public function store(StoreProductSizeRequest $request)
    {
        $productSize = ProductSize::create($request->all());

        return redirect()->route('admin.product-sizes.index');
    }

    public function edit(ProductSize $productSize)
    {
        abort_if(Gate::denies('product_size_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productSizes.edit', compact('productSize'));
    }

    public function update(UpdateProductSizeRequest $request, ProductSize $productSize)
    {
        $productSize->update($request->all());

        return redirect()->route('admin.product-sizes.index');
    }

    public function show(ProductSize $productSize)
    {
        abort_if(Gate::denies('product_size_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productSizes.show', compact('productSize'));
    }

    public function destroy(ProductSize $productSize)
    {
        abort_if(Gate::denies('product_size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSize->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductSizeRequest $request)
    {
        ProductSize::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function changeStatus(Request $request)
    {
        $model = ProductSize::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
