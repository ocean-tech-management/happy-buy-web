<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionRedeemProductRequest;
use App\Http\Requests\StoreTransactionRedeemProductRequest;
use App\Http\Requests\StoreTransactionRedeemProductShipRequest;
use App\Http\Requests\UpdateTransactionRedeemProductRequest;
use App\Models\AddressBook;
use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ShippingCompany;
use App\Models\TransactionIdLog;
use App\Models\TransactionRedeemProduct;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransactionRedeemProductController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_redeem_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if ($request->is('admin/transaction-redeem-products/new')) {
                $request->request->add(['status' => 1]);               
            }else if ($request->is('admin/transaction-redeem-products/shipped')) {
                $request->request->add(['status' => 2]);
            }else if ($request->is('admin/transaction-redeem-products/completed')) {
                $request->request->add(['status' => 3]);
            }else if ($request->is('admin/transaction-redeem-products/cancel')) {
                $request->request->add(['status' => 4]);                
            }

            $query = TransactionRedeemProduct::with(['product', 'variant', 'user', 'address', 'shipped_by', 'completed_by', 'refund_by', 'shipping_company'])->search($request)->select(sprintf('%s.*', (new TransactionRedeemProduct())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_redeem_product_show';
                $editGate = 'transaction_redeem_product_edit';
                $deleteGate = 'transaction_redeem_product_delete';
                $toShipGate = 'transaction_redeem_product_to_ship';
                $cancelGate = 'transaction_redeem_product_cancel';
                $completeGate = 'transaction_redeem_product_complete';
                $crudRoutePart = 'transaction-redeem-products';

                return view('partials.datatablesActions_TransactionRedeemProduct', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'toShipGate',
                'cancelGate',
                'completeGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('transaction', function ($row) {
                return $row->transaction ? $row->transaction : '';
            });
            $table->addColumn('product_name_en', function ($row) {
                return $row->product ? $row->product->name_en : '';
            });

            $table->addColumn('variant_quantity', function ($row) {
                return $row->variant ? $row->variant->color->name.", ".$row->variant->size->name.", ".$row->variant->quantity : '';
            });

            $table->editColumn('variant.sku', function ($row) {
                return $row->variant ? (is_string($row->variant) ? $row->variant : $row->variant->sku) : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('purchase_price', function ($row) {
                return $row->purchase_price ? $row->purchase_price : '';
            });
            $table->editColumn('purchase_quantity', function ($row) {
                return $row->purchase_quantity ? $row->purchase_quantity : '';
            });
            $table->editColumn('pre_point_balance', function ($row) {
                return $row->pre_point_balance ? $row->pre_point_balance : '';
            });
            $table->editColumn('post_point_balance', function ($row) {
                return $row->post_point_balance ? $row->post_point_balance : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? TransactionRedeemProduct::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('collect_type', function ($row) {
                return $row->collect_type ? TransactionRedeemProduct::COLLECT_TYPE_SELECT[$row->collect_type] : '';
            });
            $table->addColumn('address_user', function ($row) {
                return $row->address ? $row->address->user : '';
            });

            $table->addColumn('shipped_by_name', function ($row) {
                return $row->shipped_by ? $row->shipped_by->name : '';
            });

            $table->addColumn('completed_by_name', function ($row) {
                return $row->completed_by ? $row->completed_by->name : '';
            });

            $table->addColumn('refund_by_name', function ($row) {
                return $row->refund_by ? $row->refund_by->name : '';
            });

            $table->addColumn('shipping_company_name', function ($row) {
                return $row->shipping_company ? $row->shipping_company->name : '';
            });

            $table->editColumn('tracking_code', function ($row) {
                return $row->tracking_code ? $row->tracking_code : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'variant', 'user', 'address', 'shipped_by', 'completed_by', 'refund_by', 'shipping_company']);

            return $table->make(true);
        }
        
        return view('admin.transactionRedeemProducts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_redeem_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = AddressBook::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipped_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $completed_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refund_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ShippingCompany::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionRedeemProducts.create', compact('products', 'variants', 'users', 'addresses', 'shipped_bies', 'completed_bies', 'refund_bies', 'shipping_companies'));
    }

    public function store(StoreTransactionRedeemProductRequest $request)
    {
        $variant = ProductVariant::findOrFail($request->variant_id);
        $role = User::findOrFail($request->user_id)->roles[0]->name;

        if ($role == "Merchant"){
            $request->request->add(['purchase_price' => $variant->merchant_president_price + $variant->price_add_on]);
        }else{
            $request->request->add(['purchase_price' => $variant->agent_director_price + $variant->price_add_on]);
        }
        $request->request->add(['product_id' => $variant->product_id]);
        $request->request->add(['purchase_name' => $variant->product->name_en]);
        $request->request->add(['purchase_quantity' => $variant->quantity]);
        $request->request->add(['purchase_color' => $variant->color->name]);
        $request->request->add(['purchase_size' => $variant->size->name]);

        $transactionRedeemProduct = TransactionRedeemProduct::create($request->all());
        $transactionRedeemProduct->update([
            'transaction' => TransactionIdLog::generateTransactionId(2, $transactionRedeemProduct->user_id, $transactionRedeemProduct->id)
        ]);

        return redirect()->route('admin.transaction-redeem-products.index');
    }

    public function edit(TransactionRedeemProduct $transactionRedeemProduct)
    {
        abort_if(Gate::denies('transaction_redeem_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = AddressBook::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipped_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $completed_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $refund_bies = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ShippingCompany::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionRedeemProduct->load('product', 'user', 'address', 'shipped_by', 'completed_by', 'refund_by', 'shipping_company', 'variant');

        return view('admin.transactionRedeemProducts.edit', compact('products', 'users', 'addresses', 'shipped_bies', 'completed_bies', 'refund_bies', 'shipping_companies', 'transactionRedeemProduct', 'variants'));
    }

    public function update(UpdateTransactionRedeemProductRequest $request, TransactionRedeemProduct $transactionRedeemProduct)
    {
        $transactionRedeemProduct->update($request->all());

        return redirect()->route('admin.transaction-redeem-products.index');
    }

    public function show(TransactionRedeemProduct $transactionRedeemProduct)
    {
        abort_if(Gate::denies('transaction_redeem_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionRedeemProduct->load('product', 'user', 'address', 'shipped_by', 'completed_by', 'refund_by', 'shipping_company');

        return view('admin.transactionRedeemProducts.show', compact('transactionRedeemProduct'));
    }

    public function destroy(TransactionRedeemProduct $transactionRedeemProduct)
    {
        abort_if(Gate::denies('transaction_redeem_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionRedeemProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionRedeemProductRequest $request)
    {
        TransactionRedeemProduct::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function toShip(Request $request)
    {
        $transactionRedeemProduct = TransactionRedeemProduct::findOrFail(request('id'));

        $variants = ProductVariant::pluck('sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ShippingCompany::whereStatus('1')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionRedeemProducts.to_ship', compact('shipping_companies', 'variants', 'transactionRedeemProduct'));
    }

    public function confirmShip(StoreTransactionRedeemProductShipRequest $request)
    {
        $transactionRedeemProduct = TransactionRedeemProduct::findOrFail(request('id'));

        $transactionRedeemProduct->update([
            'shipping_company_id' => request('shipping_company_id'),
            'tracking_code' => request('tracking_code'),
            'status' => 2,
            'shipped_by_id' => Auth::guard('admin')->user()->id,
            'shipout_at' => Carbon::now(),
        ]);
        return redirect()->route('admin.transaction-redeem-products.shipped');
    }

    public function toCancel(Request $request)
    {
        $model = TransactionRedeemProduct::findOrFail(request('id'));

        $model->update([
            'status' => 4,
            'refund_by_id' => Auth::guard('admin')->user()->id,
            'refund_at' => Carbon::now(),
        ]);

        return back();
    }

    public function toComplete(Request $request)
    {
        $model = TransactionRedeemProduct::findOrFail(request('id'));

        $model->update([
            'status' => 3,
            'completed_by_id' => Auth::guard('admin')->user()->id,
            'completed_at' => Carbon::now(),
        ]);

        return back();
    }
}
