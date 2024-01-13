<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BonusTopUpGroup extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'bonus_top_up_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'point_package_id',
        'first_upline_bonus',
        'second_upline_bonus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function point_package()
    {
        return $this->belongsTo(PointPackage::class, 'point_package_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
