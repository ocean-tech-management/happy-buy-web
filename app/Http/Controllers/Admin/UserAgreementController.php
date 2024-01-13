<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserAgreementRequest;
use App\Http\Requests\StoreUserAgreementRequest;
use App\Http\Requests\UpdateUserAgreementRequest;
use App\Models\Role;
use App\Models\UserAgreement;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserAgreementController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_agreement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserAgreement::with(['role'])->select(sprintf('%s.*', (new UserAgreement())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_agreement_show';
                $editGate = 'user_agreement_edit';
                $deleteGate = 'user_agreement_delete';
                $crudRoutePart = 'user-agreements';

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
            $table->addColumn('role_title', function ($row) {
                return $row->role ? $row->role->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'role']);

            return $table->make(true);
        }

        return view('admin.userAgreements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_agreement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userAgreements.create', compact('roles'));
    }

    public function store(StoreUserAgreementRequest $request)
    {
        $userAgreement = UserAgreement::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userAgreement->id]);
        }

        return redirect()->route('admin.user-agreements.index');
    }

    public function edit(UserAgreement $userAgreement)
    {
        abort_if(Gate::denies('user_agreement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::whereGuardName('user')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userAgreement->load('role');

        return view('admin.userAgreements.edit', compact('roles', 'userAgreement'));
    }

    public function update(UpdateUserAgreementRequest $request, UserAgreement $userAgreement)
    {
        $userAgreement->update($request->all());

        return redirect()->route('admin.user-agreements.index');
    }

    public function show(UserAgreement $userAgreement)
    {
        abort_if(Gate::denies('user_agreement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAgreement->load('role');

        return view('admin.userAgreements.show', compact('userAgreement'));
    }

    public function destroy(UserAgreement $userAgreement)
    {
        abort_if(Gate::denies('user_agreement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAgreement->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserAgreementRequest $request)
    {
        UserAgreement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_agreement_create') && Gate::denies('user_agreement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserAgreement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
