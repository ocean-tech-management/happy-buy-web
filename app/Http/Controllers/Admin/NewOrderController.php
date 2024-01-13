<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNewOrderRequest;
use App\Http\Requests\StoreNewOrderRequest;
use App\Http\Requests\UpdateNewOrderRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('new_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('new_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newOrders.create');
    }

    public function store(StoreNewOrderRequest $request)
    {
        $newOrder = NewOrder::create($request->all());

        return redirect()->route('admin.new-orders.index');
    }

    public function edit(NewOrder $newOrder)
    {
        abort_if(Gate::denies('new_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newOrders.edit', compact('newOrder'));
    }

    public function update(UpdateNewOrderRequest $request, NewOrder $newOrder)
    {
        $newOrder->update($request->all());

        return redirect()->route('admin.new-orders.index');
    }

    public function show(NewOrder $newOrder)
    {
        abort_if(Gate::denies('new_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newOrders.show', compact('newOrder'));
    }

    public function destroy(NewOrder $newOrder)
    {
        abort_if(Gate::denies('new_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewOrderRequest $request)
    {
        NewOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
