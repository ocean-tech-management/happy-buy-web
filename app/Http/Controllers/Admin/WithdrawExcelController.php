<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWithdrawExcelRequest;
use App\Http\Requests\StoreWithdrawExcelRequest;
use App\Http\Requests\UpdateWithdrawExcelRequest;
use App\Models\Admin;
use App\Models\WithdrawExcel;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WithdrawExcelController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('withdraw_excel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WithdrawExcel::with(['admin'])->select(sprintf('%s.*', (new WithdrawExcel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'withdraw_excel_show';
                $editGate = 'withdraw_excel_edit';
                $deleteGate = 'withdraw_excel_delete';
                $crudRoutePart = 'withdraw-excels';

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
            $table->addColumn('admin_name', function ($row) {
                return $row->admin ? $row->admin->name : '';
            });

            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'admin', 'file']);

            return $table->make(true);
        }

        return view('admin.withdrawExcels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('withdraw_excel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.withdrawExcels.create', compact('admins'));
    }

    public function store(StoreWithdrawExcelRequest $request)
    {
        $withdrawExcel = WithdrawExcel::create($request->all());

        if ($request->input('file', false)) {
            $withdrawExcel->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $withdrawExcel->id]);
        }

        return redirect()->route('admin.withdraw-excels.index');
    }

    public function edit(WithdrawExcel $withdrawExcel)
    {
        abort_if(Gate::denies('withdraw_excel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $admins = Admin::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $withdrawExcel->load('admin');

        return view('admin.withdrawExcels.edit', compact('admins', 'withdrawExcel'));
    }

    public function update(UpdateWithdrawExcelRequest $request, WithdrawExcel $withdrawExcel)
    {
        $withdrawExcel->update($request->all());

        if ($request->input('file', false)) {
            if (!$withdrawExcel->file || $request->input('file') !== $withdrawExcel->file->file_name) {
                if ($withdrawExcel->file) {
                    $withdrawExcel->file->delete();
                }
                $withdrawExcel->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($withdrawExcel->file) {
            $withdrawExcel->file->delete();
        }

        return redirect()->route('admin.withdraw-excels.index');
    }

    public function show(WithdrawExcel $withdrawExcel)
    {
        abort_if(Gate::denies('withdraw_excel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $withdrawExcel->load('admin');

        return view('admin.withdrawExcels.show', compact('withdrawExcel'));
    }

    public function destroy(WithdrawExcel $withdrawExcel)
    {
        abort_if(Gate::denies('withdraw_excel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $withdrawExcel->delete();

        return back();
    }

    public function massDestroy(MassDestroyWithdrawExcelRequest $request)
    {
        WithdrawExcel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('withdraw_excel_create') && Gate::denies('withdraw_excel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new WithdrawExcel();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
