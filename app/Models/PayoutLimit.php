<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayoutLimit extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'payout_limits';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'role_id',
        'min_amount',
        'max_amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
