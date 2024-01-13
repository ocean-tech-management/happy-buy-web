<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderItemRequest;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderItem::with(['order'])->select(sprintf('%s.*', (new OrderItem())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'order_item_show';
                $editGate = 'order_item_edit';
                $deleteGate = 'order_item_delete';
                $crudRoutePart = 'order-items';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('order_order_number', function ($row) {
                return $row->order ? $row->order->order_number : '';
            });

            $table->editColumn('product_name_en', function ($row) {
                return $row->product_name_en ? $row->product_name_en : '';
            });
            $table->editColumn('product_name_zh', function ($row) {
                return $row->product_name_zh ? $row->product_name_zh : '';
            });
            $table->editColumn('product_desc_en', function ($row) {
                return $row->product_desc_en ? $row->product_desc_en : '';
            });
            $table->editColumn('product_desc_zh', function ($row) {
                return $row->product_desc_zh ? $row->product_desc_zh : '';
            });
            $table->editColumn('product_quantity', function ($row) {
                return $row->product_quantity ? $row->product_quantity : '';
            });
            $table->editColumn('product_color', function ($row) {
                return $row->product_color ? $row->product_color : '';
            });
            $table->editColumn('product_size', function ($row) {
                return $row->product_size ? $row->product_size : '';
            });
            $table->editColumn('product_sku', function ($row) {
                return $row->product_sku ? $row->product_sku : '';
            });
            $table->editColumn('sales_price', function ($row) {
                return $row->sales_price ? $row->sales_price : '';
            });
            $table->editColumn('merchant_president_price', function ($row) {
                return $row->merchant_president_price ? $row->merchant_president_price : '';
            });
            $table->editColumn('agent_director_price', function ($row) {
                return $row->agent_director_price ? $row->agent_director_price : '';
            });
            $table->editColumn('agent_executive_price', function ($row) {
                return $row->agent_executive_price ? $row->agent_executive_price : '';
            });
            $table->editColumn('price_add_on', function ($row) {
                return $row->price_add_on ? $row->price_add_on : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'order']);

            return $table->make(true);
        }

        return view('admin.orderItems.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::pluck('order_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orderItems.create', compact('orders'));
    }

    public function store(StoreOrderItemRequest $request)
    {
        $orderItem = OrderItem::create($request->all());

        return redirect()->route('admin.order-items.index');
    }

    public function edit(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::pluck('order_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderItem->load('order');

        return view('admin.orderItems.edit', compact('orders', 'orderItem'));
    }

    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem)
    {
        $orderItem->update($request->all());

        return redirect()->route('admin.order-items.index');
    }

    public function show(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->load('order');

        return view('admin.orderItems.show', compact('orderItem'));
    }

    public function destroy(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderItemRequest $request)
    {
        OrderItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
