<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusPersonalRequest;
use App\Http\Requests\StoreBonusPersonalRequest;
use App\Http\Requests\UpdateBonusPersonalRequest;
use App\Models\BonusPersonal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BonusPersonalController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bonus_personal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BonusPersonal::query()->select(sprintf('%s.*', (new BonusPersonal())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bonus_personal_show';
                $editGate = 'bonus_personal_edit';
                $deleteGate = 'bonus_personal_delete';
                $crudRoutePart = 'bonus-personals';

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
            $table->editColumn('point', function ($row) {
                return $row->point ? $row->point : '';
            });
            $table->editColumn('percent', function ($row) {
                return $row->percent ? $row->percent : '';
            });
            $table->editColumn('after_point', function ($row) {
                return $row->after_point ? $row->after_point : '';
            });
            $table->editColumn('after_percent', function ($row) {
                return $row->after_percent ? $row->after_percent : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bonusPersonals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_personal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusPersonals.create');
    }

    public function store(StoreBonusPersonalRequest $request)
    {
        $bonusPersonal = BonusPersonal::create($request->all());

        return redirect()->route('admin.bonus-personals.index');
    }

    public function edit(BonusPersonal $bonusPersonal)
    {
        abort_if(Gate::denies('bonus_personal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusPersonals.edit', compact('bonusPersonal'));
    }

    public function update(UpdateBonusPersonalRequest $request, BonusPersonal $bonusPersonal)
    {
        $bonusPersonal->update($request->all());

        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus5');
    }

    public function show(BonusPersonal $bonusPersonal)
    {
        abort_if(Gate::denies('bonus_personal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonusPersonals.show', compact('bonusPersonal'));
    }

    public function destroy(BonusPersonal $bonusPersonal)
    {
        abort_if(Gate::denies('bonus_personal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusPersonal->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusPersonalRequest $request)
    {
        BonusPersonal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
