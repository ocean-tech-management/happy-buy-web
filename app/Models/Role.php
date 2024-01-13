<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    public const GUARD_NAME_SELECT = [
        'admin' => 'Admin',
        'user'  => 'User',
    ];

    public function pointPackages(){
        return $this->belongsToMany(PointPackage::class)->where('status', 1);
    }
}
