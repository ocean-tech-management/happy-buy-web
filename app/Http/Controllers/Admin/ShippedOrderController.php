<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShippedOrderRequest;
use App\Http\Requests\StoreShippedOrderRequest;
use App\Http\Requests\UpdateShippedOrderRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippedOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shipped_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippedOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipped_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippedOrders.create');
    }

    public function store(StoreShippedOrderRequest $request)
    {
        $shippedOrder = ShippedOrder::create($request->all());

        return redirect()->route('admin.shipped-orders.index');
    }

    public function edit(ShippedOrder $shippedOrder)
    {
        abort_if(Gate::denies('shipped_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippedOrders.edit', compact('shippedOrder'));
    }

    public function update(UpdateShippedOrderRequest $request, ShippedOrder $shippedOrder)
    {
        $shippedOrder->update($request->all());

        return redirect()->route('admin.shipped-orders.index');
    }

    public function show(ShippedOrder $shippedOrder)
    {
        abort_if(Gate::denies('shipped_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippedOrders.show', compact('shippedOrder'));
    }

    public function destroy(ShippedOrder $shippedOrder)
    {
        abort_if(Gate::denies('shipped_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippedOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippedOrderRequest $request)
    {
        ShippedOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
