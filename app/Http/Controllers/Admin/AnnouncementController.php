<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAnnouncementRequest;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Announcement;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnnouncementController extends Controller
{
    use MediaUploadingTrait;
    
    public function index(Request $request)
    {
        abort_if(Gate::denies('announcement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            $query = Announcement::with(['roles'])->select(sprintf('%s.*', (new Announcement())->table));
            $table = Datatables::of($query);
            
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            
            $table->editColumn('actions', function ($row) {
                $viewGate = 'announcement_show';
                $editGate = 'announcement_edit';
                $deleteGate = 'announcement_delete';
                $statusChangeGate = 'announcement_status_change';
                $crudRoutePart = 'announcements';
                
                return view('partials.datatablesActions_Announcement', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'statusChangeGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            
            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }
                
                return '';
            });
            $table->editColumn('role', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="badge bg-info">%s</span>', $role->name);
                }
                
                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Announcement::STATUS_SELECT[$row->status] : '';
            });
            
            $table->rawColumns(['actions', 'placeholder', 'photo', 'role']);
            
            return $table->make(true);
        }
        
        return view('admin.announcements.index');
    }
    
    public function create()
    {
        abort_if(Gate::denies('announcement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $roles = Role::whereGuardName('user')->pluck('name', 'id');
        
        return view('admin.announcements.create', compact('roles'));
    }
    
    public function store(StoreAnnouncementRequest $request)
    {
        $announcement = Announcement::create($request->all());
        $announcement->roles()->sync($request->input('roles', []));
        if ($request->input('photo', false)) {
            $announcement->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }
        
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $announcement->id]);
        }
        
        return redirect()->route('admin.announcements.index');
    }
    
    public function edit(Announcement $announcement)
    {
        abort_if(Gate::denies('announcement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $roles = Role::whereGuardName('user')->pluck('name', 'id');
        
        $announcement->load('roles');
        
        return view('admin.announcements.edit', compact('roles', 'announcement'));
    }
    
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $announcement->update($request->all());
        $announcement->roles()->sync($request->input('roles', []));
        if ($request->input('photo', false)) {
            if (!$announcement->photo || $request->input('photo') !== $announcement->photo->file_name) {
                if ($announcement->photo) {
                    $announcement->photo->delete();
                }
                $announcement->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($announcement->photo) {
            $announcement->photo->delete();
        }
        
        return redirect()->route('admin.announcements.index');
    }
    
    public function show(Announcement $announcement)
    {
        abort_if(Gate::denies('announcement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $announcement->load('roles');
        
        return view('admin.announcements.show', compact('announcement'));
    }
    
    public function destroy(Announcement $announcement)
    {
        abort_if(Gate::denies('announcement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $announcement->delete();
        
        return back();
    }
    
    public function massDestroy(MassDestroyAnnouncementRequest $request)
    {
        Announcement::whereIn('id', request('ids'))->delete();
        
        return response(null, Response::HTTP_NO_CONTENT);
    }
    
    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('announcement_create') && Gate::denies('announcement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $model         = new Announcement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');
        
        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    
    public function changeStatus(Request $request)
    {
        $model = Announcement::findOrFail(request('id'));
        $model->update([
            'status' => request('status')
        ]);
        return back();
    }
}
