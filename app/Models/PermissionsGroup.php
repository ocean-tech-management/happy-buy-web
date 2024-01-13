<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionsGroup extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'permissions_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parent()
    {
        return $this->belongsTo(PermissionsGroup::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(PermissionsGroup::class, 'parent_id');
    }

    public function permissions(){
        return $this->hasMany(Permission::class, 'group_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
