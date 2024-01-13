<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVoucherRequest;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Product;
use App\Models\Role;
use App\Models\Voucher;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VoucherController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('voucher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Voucher::with(['roles', 'product'])->select(sprintf('%s.*', (new Voucher())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'voucher_show';
                $editGate = 'voucher_edit';
                $deleteGate = 'voucher_delete';
                $crudRoutePart = 'vouchers';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Voucher::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('role', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('product_code', function ($row) {
                return $row->product ? $row->product->code : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'role', 'product']);

            return $table->make(true);
        }

        return view('admin.vouchers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('voucher_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $products = Product::all()->pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vouchers.create', compact('roles', 'products'));
    }

    public function store(StoreVoucherRequest $request)
    {
        $voucher = Voucher::create($request->all());
        $voucher->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.vouchers.index');
    }

    public function edit(Voucher $voucher)
    {
        abort_if(Gate::denies('voucher_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $products = Product::all()->pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $voucher->load('roles', 'product');

        return view('admin.vouchers.edit', compact('roles', 'products', 'voucher'));
    }

    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $voucher->update($request->all());
        $voucher->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.vouchers.index');
    }

    public function show(Voucher $voucher)
    {
        abort_if(Gate::denies('voucher_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voucher->load('roles', 'product');

        return view('admin.vouchers.show', compact('voucher'));
    }

    public function destroy(Voucher $voucher)
    {
        abort_if(Gate::denies('voucher_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $voucher->delete();

        return back();
    }

    public function massDestroy(MassDestroyVoucherRequest $request)
    {
        Voucher::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
