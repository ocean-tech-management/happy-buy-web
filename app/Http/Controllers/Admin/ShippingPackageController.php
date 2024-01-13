<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShippingPackageRequest;
use App\Http\Requests\StoreShippingPackageRequest;
use App\Http\Requests\UpdateShippingPackageRequest;
use App\Models\ShippingPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippingPackageController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('shipping_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippingPackage::query()->select(sprintf('%s.*', (new ShippingPackage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'shipping_package_show';
                $editGate = 'shipping_package_edit';
                $deleteGate = 'shipping_package_delete';
                $statusChangeGate = 'shipping_package_status_change';
                $crudRoutePart = 'shipping-packages';

                return view('partials.datatablesActions_ShippingPackage', compact(
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
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('point', function ($row) {
                return $row->point ? $row->point : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ShippingPackage::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.shippingPackages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipping_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingPackages.create');
    }

    public function store(StoreShippingPackageRequest $request)
    {
        $shippingPackage = ShippingPackage::create($request->all());

        return redirect()->route('admin.shipping-packages.index');
    }

    public function edit(ShippingPackage $shippingPackage)
    {
        abort_if(Gate::denies('shipping_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingPackages.edit', compact('shippingPackage'));
    }

    public function update(UpdateShippingPackageRequest $request, ShippingPackage $shippingPackage)
    {
        $shippingPackage->update($request->all());

        return redirect()->route('admin.shipping-packages.index');
    }

    public function show(ShippingPackage $shippingPackage)
    {
        abort_if(Gate::denies('shipping_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingPackages.show', compact('shippingPackage'));
    }

    public function destroy(ShippingPackage $shippingPackage)
    {
        abort_if(Gate::denies('shipping_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingPackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippingPackageRequest $request)
    {
        ShippingPackage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function changeStatus(Request $request)
    {
        $model = ShippingPackage::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
