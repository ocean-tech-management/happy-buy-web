<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShippingCompanyRequest;
use App\Http\Requests\StoreShippingCompanyRequest;
use App\Http\Requests\UpdateShippingCompanyRequest;
use App\Models\ShippingCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippingCompanyController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('shipping_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippingCompany::query()->select(sprintf('%s.*', (new ShippingCompany())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'shipping_company_show';
                $editGate = 'shipping_company_edit';
                $deleteGate = 'shipping_company_delete';
                $statusChangeGate = 'shipping_company_status_change';
                $crudRoutePart = 'shipping-companies';

                return view('partials.datatablesActions_ShippingCompany', compact(
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
            $table->editColumn('api_name', function ($row) {
                return $row->api_name ? $row->api_name : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ShippingCompany::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.shippingCompanies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipping_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingCompanies.create');
    }

    public function store(StoreShippingCompanyRequest $request)
    {
        $shippingCompany = ShippingCompany::create($request->all());

        return redirect()->route('admin.shipping-companies.index');
    }

    public function edit(ShippingCompany $shippingCompany)
    {
        abort_if(Gate::denies('shipping_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingCompanies.edit', compact('shippingCompany'));
    }

    public function update(UpdateShippingCompanyRequest $request, ShippingCompany $shippingCompany)
    {
        $shippingCompany->update($request->all());

        return redirect()->route('admin.shipping-companies.index');
    }

    public function show(ShippingCompany $shippingCompany)
    {
        abort_if(Gate::denies('shipping_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingCompanies.show', compact('shippingCompany'));
    }

    public function destroy(ShippingCompany $shippingCompany)
    {
        abort_if(Gate::denies('shipping_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingCompany->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippingCompanyRequest $request)
    {
        ShippingCompany::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function changeStatus(Request $request)
    {
        $model = ShippingCompany::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
