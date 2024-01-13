<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShippingFeeRequest;
use App\Http\Requests\StoreShippingFeeRequest;
use App\Http\Requests\UpdateShippingFeeRequest;
use App\Models\ShippingFee;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippingFeeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('shipping_fee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippingFee::with(['states'])->search($request)->select(sprintf('%s.*', (new ShippingFee())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'shipping_fee_show';
                $editGate = 'shipping_fee_edit';
                $deleteGate = 'shipping_fee_delete';
                $statusChangeGate = 'shipping_fee_status_change';
                $crudRoutePart = 'shipping-fees';

                return view('partials.datatablesActions_ShippingFee', compact(
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
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('state', function ($row) {
                $labels = [];
                foreach ($row->states as $state) {
                    $labels[] = sprintf('<span class="badge bg-info">%s</span>', $state->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ShippingFee::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'state']);

            return $table->make(true);
        }

        return view('admin.shippingFees.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipping_fee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('name', 'id');

        return view('admin.shippingFees.create', compact('states'));
    }

    public function store(StoreShippingFeeRequest $request)
    {
        $shippingFee = ShippingFee::create($request->all());
        $shippingFee->states()->sync($request->input('states', []));

        return redirect()->route('admin.shipping-fees.index');
    }

    public function edit(ShippingFee $shippingFee)
    {
        abort_if(Gate::denies('shipping_fee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('name', 'id');

        $shippingFee->load('states');

        return view('admin.shippingFees.edit', compact('states', 'shippingFee'));
    }

    public function update(UpdateShippingFeeRequest $request, ShippingFee $shippingFee)
    {
        $shippingFee->update($request->all());
        $shippingFee->states()->sync($request->input('states', []));

        return redirect()->route('admin.shipping-fees.index');
    }

    public function show(ShippingFee $shippingFee)
    {
        abort_if(Gate::denies('shipping_fee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingFee->load('states');

        return view('admin.shippingFees.show', compact('shippingFee'));
    }

    public function destroy(ShippingFee $shippingFee)
    {
        abort_if(Gate::denies('shipping_fee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingFee->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippingFeeRequest $request)
    {
        ShippingFee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function changeStatus(Request $request)
    {
        $model = ShippingFee::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
