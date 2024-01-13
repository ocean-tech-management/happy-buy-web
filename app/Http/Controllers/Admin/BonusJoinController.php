<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusJoinRequest;
use App\Http\Requests\StoreBonusJoinRequest;
use App\Http\Requests\UpdateBonusJoinRequest;
use App\Models\BonusJoin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BonusJoinController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bonus_join_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BonusJoin::query()->select(sprintf('%s.*', (new BonusJoin())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bonus_join_show';
                $editGate = 'bonus_join_edit';
                $deleteGate = 'bonus_join_delete';
                $crudRoutePart = 'bonus-joins';

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
            $table->editColumn('first_upline_bonus', function ($row) {
                return $row->first_upline_bonus ? $row->first_upline_bonus : '';
            });
            $table->editColumn('second_upline_bonus', function ($row) {
                return $row->second_upline_bonus ? $row->second_upline_bonus : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bonusJoins.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_join_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusJoins.create');
    }

    public function store(StoreBonusJoinRequest $request)
    {
        $bonusJoin = BonusJoin::create($request->all());

        return redirect()->route('admin.bonus-joins.index');
    }

    public function edit(BonusJoin $bonusJoin)
    {
        abort_if(Gate::denies('bonus_join_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusJoins.edit', compact('bonusJoin'));
    }

    public function update(UpdateBonusJoinRequest $request, BonusJoin $bonusJoin)
    {
        $bonusJoin->update($request->all());

        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus1');
    }

    public function show(BonusJoin $bonusJoin)
    {
        abort_if(Gate::denies('bonus_join_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusJoins.show', compact('bonusJoin'));
    }

    public function destroy(BonusJoin $bonusJoin)
    {
        abort_if(Gate::denies('bonus_join_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusJoin->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusJoinRequest $request)
    {
        BonusJoin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
