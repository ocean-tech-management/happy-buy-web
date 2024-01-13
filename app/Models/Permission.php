<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{

    public const GUARD_NAME_SELECT = [
        'admin' => 'Admin',
        'user'  => 'User',
    ];

    public function group()
    {
        return $this->belongsTo(PermissionsGroup::class, 'group_id');
    }

    public function scopeSearch($query, $request)
    {        
        if ($request->has('title')){
            $query->when($request['title'] && filled($request['title']), function($q) use($request){
                $q->where('name', $request['title']);
            });
        }; 
        
        if ($request->has('guard_name')){
            $query->when($request['guard_name'] && filled($request['guard_name']), function($q) use($request){
                $q->where('guard_name', 'like', '%'. $request['guard_name'] . '%');
            });
        };
        
        if($request->has('permission_group')){
            $query->when($request['permission_group'] && filled($request['permission_group']), function ($q) use($request) {
                $q->whereHas(
                    'group', function($q) use($request){
                        $q->where('id', $request['permission_group']);
                    }
                );
            });
        }

        return $query;
    }
}
