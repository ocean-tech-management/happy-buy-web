<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCancelledOrderRequest;
use App\Http\Requests\StoreCancelledOrderRequest;
use App\Http\Requests\UpdateCancelledOrderRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CancelledOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cancelled_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cancelledOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cancelled_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cancelledOrders.create');
    }

    public function store(StoreCancelledOrderRequest $request)
    {
        $cancelledOrder = CancelledOrder::create($request->all());

        return redirect()->route('admin.cancelled-orders.index');
    }

    public function edit(CancelledOrder $cancelledOrder)
    {
        abort_if(Gate::denies('cancelled_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cancelledOrders.edit', compact('cancelledOrder'));
    }

    public function update(UpdateCancelledOrderRequest $request, CancelledOrder $cancelledOrder)
    {
        $cancelledOrder->update($request->all());

        return redirect()->route('admin.cancelled-orders.index');
    }

    public function show(CancelledOrder $cancelledOrder)
    {
        abort_if(Gate::denies('cancelled_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cancelledOrders.show', compact('cancelledOrder'));
    }

    public function destroy(CancelledOrder $cancelledOrder)
    {
        abort_if(Gate::denies('cancelled_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cancelledOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyCancelledOrderRequest $request)
    {
        CancelledOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
