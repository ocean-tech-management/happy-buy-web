<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRankingRequest;
use App\Http\Requests\StoreRankingRequest;
use App\Http\Requests\UpdateRankingRequest;
use App\Models\Ranking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('ranking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ranking::query()->select(sprintf('%s.*', (new Ranking())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ranking_show';
                $editGate = 'ranking_edit';
                $deleteGate = 'ranking_delete';
                $crudRoutePart = 'rankings';

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
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('name_zh', function ($row) {
                return $row->name_zh ? $row->name_zh : '';
            });
            $table->editColumn('point', function ($row) {
                return $row->point ? $row->point : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.rankings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ranking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rankings.create');
    }

    public function store(StoreRankingRequest $request)
    {
        $ranking = Ranking::create($request->all());

        return redirect()->route('admin.rankings.index');
    }

    public function edit(Ranking $ranking)
    {
        abort_if(Gate::denies('ranking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rankings.edit', compact('ranking'));
    }

    public function update(UpdateRankingRequest $request, Ranking $ranking)
    {
        $ranking->update($request->all());

        return redirect()->route('admin.rankings.index');
    }

    public function show(Ranking $ranking)
    {
        abort_if(Gate::denies('ranking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rankings.show', compact('ranking'));
    }

    public function destroy(Ranking $ranking)
    {
        abort_if(Gate::denies('ranking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ranking->delete();

        return back();
    }

    public function massDestroy(MassDestroyRankingRequest $request)
    {
        Ranking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
