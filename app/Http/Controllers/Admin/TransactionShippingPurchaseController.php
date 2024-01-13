<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTransactionShippingPurchaseRequest;
use App\Http\Requests\StoreTransactionShippingPurchaseRequest;
use App\Http\Requests\UpdateTransactionShippingPurchaseRequest;
use App\Models\Admin;
use App\Models\PaymentMethod;
use App\Models\ShippingBalance;
use App\Models\ShippingPackage;
use App\Models\TransactionIdLog;
use App\Models\TransactionShippingPurchase;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class TransactionShippingPurchaseController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_shipping_purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if ($request->is('admin/transaction-shipping-purchases/failed')) {
                $request->request->add(['status' => 1]);
            }else if ($request->is('admin/transaction-shipping-purchases/verified')) {
                $request->request->add(['status' => 3]);
            }else if ($request->is('admin/transaction-shipping-purchases/new')) {
                $request->request->add(['status' => 2]);
            }

            $query = TransactionShippingPurchase::with(['user', 'shipping_package', 'payment_method', 'admin'])->search($request)->select(sprintf('%s.*', (new TransactionShippingPurchase())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_shipping_purchase_show';
                $editGate = 'transaction_shipping_purchase_edit';
                $deleteGate = 'transaction_shipping_purchase_delete';
                $toVerifyGate = 'transaction_shipping_purchase_to_verify';
                $toRejectGate = 'transaction_shipping_purchase_to_reject';
                $crudRoutePart = 'transaction-shipping-purchases';

                return view('partials.datatablesActions_TransactionShippingPurchase', compact(
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
            $table->editColumn('transaction', function ($row) {
                return $row->transaction ? $row->transaction : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('shipping_package_price', function ($row) {
                return $row->shipping_package ? $row->shipping_package->price : '';
            });

            $table->editColumn('shipping_package.price', function ($row) {
                return $row->shipping_package ? (is_string($row->shipping_package) ? $row->shipping_package : $row->shipping_package->price) : '';
            });
            $table->editColumn('point', function ($row) {
                return $row->point ? $row->point : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->addColumn('payment_method_name', function ($row) {
                return $row->payment_method ? $row->payment_method->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? TransactionShippingPurchase::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('receipt', function ($row) {
                if ($photo = $row->receipt) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->addColumn('admin_name', function ($row) {
                return $row->admin ? $row->admin->name : '';
            });

            $table->editColumn('gateway_response', function ($row) {
                return $row->gateway_response ? $row->gateway_response : '';
            });
            $table->editColumn('gateway_status', function ($row) {
                return $row->gateway_status ? TransactionShippingPurchase::GATEWAY_STATUS_SELECT[$row->gateway_status] : '';
            });
            $table->editColumn('gateway_transaction', function ($row) {
                return $row->gateway_transaction ? $row->gateway_transaction : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'shipping_package', 'payment_method', 'receipt', 'admin']);

            return $table->make(true);
        }

        return view('admin.transactionShippingPurchases.index');
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_shipping_purchase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_packages = ShippingPackage::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionShippingPurchases.create', compact('users', 'shipping_packages', 'payment_methods', 'admins'));
    }

    public function store(StoreTransactionShippingPurchaseRequest $request)
    {
        $shipping_package = ShippingPackage::findOrFail(request('shipping_package_id'));

        $request->request->add(['point' => $shipping_package->point]);
        $request->request->add(['price' => $shipping_package->price]);

        $transactionShippingPurchase = TransactionShippingPurchase::create($request->all());

        $order_number = TransactionIdLog::generateTransactionId(6, $transactionShippingPurchase->user_id, $transactionShippingPurchase->id);
        $transactionShippingPurchase->update([
            'transaction' => $order_number,
        ]);

        if ($request->input('receipt', false)) {
            $transactionShippingPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transactionShippingPurchase->id]);
        }

        return redirect()->route('admin.transaction-shipping-purchases.index');
    }

    public function edit(TransactionShippingPurchase $transactionShippingPurchase)
    {
        abort_if(Gate::denies('transaction_shipping_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_packages = ShippingPackage::pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_methods = PaymentMethod::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionShippingPurchase->load('user', 'shipping_package', 'payment_method', 'admin');

        return view('admin.transactionShippingPurchases.edit', compact('users', 'shipping_packages', 'payment_methods', 'admins', 'transactionShippingPurchase'));
    }

    public function update(UpdateTransactionShippingPurchaseRequest $request, TransactionShippingPurchase $transactionShippingPurchase)
    {
        $transactionShippingPurchase->update($request->all());

        if ($request->input('receipt', false)) {
            if (!$transactionShippingPurchase->receipt || $request->input('receipt') !== $transactionShippingPurchase->receipt->file_name) {
                if ($transactionShippingPurchase->receipt) {
                    $transactionShippingPurchase->receipt->delete();
                }
                $transactionShippingPurchase->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt'))))->toMediaCollection('receipt');
            }
        } elseif ($transactionShippingPurchase->receipt) {
            $transactionShippingPurchase->receipt->delete();
        }

        return redirect()->route('admin.transaction-shipping-purchases.index');
    }

    public function show(TransactionShippingPurchase $transactionShippingPurchase)
    {
        abort_if(Gate::denies('transaction_shipping_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionShippingPurchase->load('user', 'shipping_package', 'payment_method', 'admin');

        return view('admin.transactionShippingPurchases.show', compact('transactionShippingPurchase'));
    }

    public function destroy(TransactionShippingPurchase $transactionShippingPurchase)
    {
        abort_if(Gate::denies('transaction_shipping_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionShippingPurchase->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionShippingPurchaseRequest $request)
    {
        TransactionShippingPurchase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transaction_shipping_purchase_create') && Gate::denies('transaction_shipping_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TransactionShippingPurchase();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function toVerify(Request $request)
    {
        $model = TransactionShippingPurchase::findOrFail(request('id'));
        $point = $model->point;
        $user_id = $model->user_id;
        $order_number = $model->transaction;
        $user = $model->user;

        $model->update([
            'status' => 3,
            'admin_id' => Auth::guard('admin')->user()->id,
            'payment_verified_at' => Carbon::now(),
        ]);

        if ($model){
            DB::beginTransaction();
            try{
                ShippingBalance::create([
                    'amount' => $point,
                    'user_id' => $user_id,
                    'status' => 1,
                    'settlement' => 1,
                    'remark' => "purchase shipping ".$order_number,
                ]);
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollBack();
                return back();
            }
        }
        return back();
    }

    public function toReject(Request $request)
    {
        $model = TransactionShippingPurchase::findOrFail(request('id'));
        $point = $model->point;
        $user_id = $model->user_id;
        $order_number = $model->transaction;
        $model->update([
            'status' => 1,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        return back();
    }

    public function transactionShippingPurchaseReceiptPDF($id){
        $receipt = TransactionShippingPurchase::find($id);
        $receipt->name ="Shipping Top Up Receipt";
        $receipt->footnote ="Foot Note";
        $pdf = PDF::loadView('user.print.shipping-receipt', compact('receipt'));
        $pdf->setOption('print-media-type', true);
        $pdf->setOption('margin-bottom', '0mm');
        $pdf->setOption('margin-top', '1mm');
        $pdf->setOption('margin-right', '3mm');
        $pdf->setOption('margin-left', '0mm');
        return $pdf->inline($receipt->name.".pdf");
    }
}
