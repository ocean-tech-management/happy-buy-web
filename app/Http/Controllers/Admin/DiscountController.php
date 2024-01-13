<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDiscountRequest;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Models\Discount;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('discount_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Discount::with(['roles'])->select(sprintf('%s.*', (new Discount())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'discount_show';
                $editGate = 'discount_edit';
                $deleteGate = 'discount_delete';
                $crudRoutePart = 'discounts';

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

            $table->editColumn('percent', function ($row) {
                return $row->percent ? $row->percent : '';
            });
            $table->editColumn('role', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="badge bg-info">%s</span>', $role->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Discount::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'role']);

            return $table->make(true);
        }

        return view('admin.discounts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('discount_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id');

        return view('admin.discounts.create', compact('roles'));
    }

    public function store(StoreDiscountRequest $request)
    {
        $discount = Discount::create($request->all());
        $discount->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.discounts.index');
    }

    public function edit(Discount $discount)
    {
        abort_if(Gate::denies('discount_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id');

        $discount->load('roles');

        return view('admin.discounts.edit', compact('roles', 'discount'));
    }

    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount->update($request->all());
        $discount->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.discounts.index');
    }

    public function show(Discount $discount)
    {
        abort_if(Gate::denies('discount_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $discount->load('roles');

        return view('admin.discounts.show', compact('discount'));
    }

    public function destroy(Discount $discount)
    {
        abort_if(Gate::denies('discount_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $discount->delete();

        return back();
    }

    public function massDestroy(MassDestroyDiscountRequest $request)
    {
        Discount::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
