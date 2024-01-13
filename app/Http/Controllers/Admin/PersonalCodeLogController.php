<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPersonalCodeLogRequest;
use App\Http\Requests\StorePersonalCodeLogRequest;
use App\Http\Requests\UpdatePersonalCodeLogRequest;
use App\Models\PersonalCodeLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PersonalCodeLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('personal_code_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PersonalCodeLog::query()->select(sprintf('%s.*', (new PersonalCodeLog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
//            $table->addColumn('actions', '&nbsp;');
//
//            $table->editColumn('actions', function ($row) {
//                $viewGate = 'personal_code_log_show';
//                $editGate = 'personal_code_log_edit';
//                $deleteGate = 'personal_code_log_delete';
//                $crudRoutePart = 'personal-code-logs';
//
//                return view('partials.datatablesActions', compact(
//                'viewGate',
//                'editGate',
//                'deleteGate',
//                'crudRoutePart',
//                'row'
//            ));
//            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['placeholder']);

            return $table->make(true);
        }

        return view('admin.personalCodeLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('personal_code_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personalCodeLogs.create');
    }

    public function store(StorePersonalCodeLogRequest $request)
    {
        $personalCodeLog = PersonalCodeLog::create($request->all());

        return redirect()->route('admin.personal-code-logs.index');
    }

    public function edit(PersonalCodeLog $personalCodeLog)
    {
        abort_if(Gate::denies('personal_code_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personalCodeLogs.edit', compact('personalCodeLog'));
    }

    public function update(UpdatePersonalCodeLogRequest $request, PersonalCodeLog $personalCodeLog)
    {
        $personalCodeLog->update($request->all());

        return redirect()->route('admin.personal-code-logs.index');
    }

    public function show(PersonalCodeLog $personalCodeLog)
    {
        abort_if(Gate::denies('personal_code_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.personalCodeLogs.show', compact('personalCodeLog'));
    }

    public function destroy(PersonalCodeLog $personalCodeLog)
    {
        abort_if(Gate::denies('personal_code_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalCodeLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyPersonalCodeLogRequest $request)
    {
        PersonalCodeLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
