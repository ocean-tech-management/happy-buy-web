<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductColorRequest;
use App\Http\Requests\StoreProductColorRequest;
use App\Http\Requests\UpdateProductColorRequest;
use App\Models\ProductColor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductColorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_color_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductColor::query()->search($request)->select(sprintf('%s.*', (new ProductColor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_color_show';
                $editGate = 'product_color_edit';
                $deleteGate = 'product_color_delete';
                $statusChangeGate = 'product_color_status_change';
                $crudRoutePart = 'product-colors';

                return view('partials.datatablesActions_ProductColor', compact(
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
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ProductColor::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.productColors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_color_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productColors.create');
    }

    public function store(StoreProductColorRequest $request)
    {
        $productColor = ProductColor::create($request->all());

        return redirect()->route('admin.product-colors.index');
    }

    public function edit(ProductColor $productColor)
    {
        abort_if(Gate::denies('product_color_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productColors.edit', compact('productColor'));
    }

    public function update(UpdateProductColorRequest $request, ProductColor $productColor)
    {
        $productColor->update($request->all());

        return redirect()->route('admin.product-colors.index');
    }

    public function show(ProductColor $productColor)
    {
        abort_if(Gate::denies('product_color_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productColors.show', compact('productColor'));
    }

    public function destroy(ProductColor $productColor)
    {
        abort_if(Gate::denies('product_color_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productColor->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductColorRequest $request)
    {
        ProductColor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function changeStatus(Request $request)
    {
        $model = ProductColor::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
