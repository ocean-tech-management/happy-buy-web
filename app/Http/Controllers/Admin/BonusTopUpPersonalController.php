<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonusTopUpPersonalRequest;
use App\Http\Requests\StoreBonusTopUpPersonalRequest;
use App\Http\Requests\UpdateBonusTopUpPersonalRequest;
use App\Models\BonusTopUpPersonal;
use App\Models\PointPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BonusTopUpPersonalController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bonus_top_up_personal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BonusTopUpPersonal::with(['point_package'])->select(sprintf('%s.*', (new BonusTopUpPersonal())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bonus_top_up_personal_show';
                $editGate = 'bonus_top_up_personal_edit';
                $deleteGate = 'bonus_top_up_personal_delete';
                $crudRoutePart = 'bonus-top-up-personals';

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
            $table->addColumn('point_package_name_en', function ($row) {
                return $row->point_package ? $row->point_package->name_en : '';
            });

            $table->editColumn('first_upline_bonus', function ($row) {
                return $row->first_upline_bonus ? $row->first_upline_bonus : '';
            });
            $table->editColumn('second_upline_bonus', function ($row) {
                return $row->second_upline_bonus ? $row->second_upline_bonus : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'point_package']);

            return $table->make(true);
        }

        return view('admin.bonusTopUpPersonals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonus_top_up_personal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_packages = PointPackage::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bonusTopUpPersonals.create', compact('point_packages'));
    }

    public function store(StoreBonusTopUpPersonalRequest $request)
    {
        $bonusTopUpPersonal = BonusTopUpPersonal::create($request->all());

        return redirect()->route('admin.bonus-top-up-personals.index');
    }

    public function edit(BonusTopUpPersonal $bonusTopUpPersonal)
    {
        abort_if(Gate::denies('bonus_top_up_personal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point_packages = PointPackage::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bonusTopUpPersonal->load('point_package');

        return view('admin.bonusTopUpPersonals.edit', compact('point_packages', 'bonusTopUpPersonal'));
    }

    public function update(UpdateBonusTopUpPersonalRequest $request, BonusTopUpPersonal $bonusTopUpPersonal)
    {
        $bonusTopUpPersonal->update($request->all());

        return redirect()->route('admin.bonus-settings.index')->with('tab', 'bonus3');
    }

    public function show(BonusTopUpPersonal $bonusTopUpPersonal)
    {
        abort_if(Gate::denies('bonus_top_up_personal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusTopUpPersonal->load('point_package');

        return view('admin.bonusTopUpPersonals.show', compact('bonusTopUpPersonal'));
    }

    public function destroy(BonusTopUpPersonal $bonusTopUpPersonal)
    {
        abort_if(Gate::denies('bonus_top_up_personal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusTopUpPersonal->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonusTopUpPersonalRequest $request)
    {
        BonusTopUpPersonal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
