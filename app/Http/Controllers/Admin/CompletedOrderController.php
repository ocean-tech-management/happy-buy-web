<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompletedOrderRequest;
use App\Http\Requests\StoreCompletedOrderRequest;
use App\Http\Requests\UpdateCompletedOrderRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompletedOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('completed_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.completedOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('completed_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.completedOrders.create');
    }

    public function store(StoreCompletedOrderRequest $request)
    {
        $completedOrder = CompletedOrder::create($request->all());

        return redirect()->route('admin.completed-orders.index');
    }

    public function edit(CompletedOrder $completedOrder)
    {
        abort_if(Gate::denies('completed_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.completedOrders.edit', compact('completedOrder'));
    }

    public function update(UpdateCompletedOrderRequest $request, CompletedOrder $completedOrder)
    {
        $completedOrder->update($request->all());

        return redirect()->route('admin.completed-orders.index');
    }

    public function show(CompletedOrder $completedOrder)
    {
        abort_if(Gate::denies('completed_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.completedOrders.show', compact('completedOrder'));
    }

    public function destroy(CompletedOrder $completedOrder)
    {
        abort_if(Gate::denies('completed_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $completedOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompletedOrderRequest $request)
    {
        CompletedOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
