<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UplinePreserveLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'upline_preserve_log';

    protected $dates = [
        'referred_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'direct_upline_id',
        'upline_user_id',
        'upline_user_1_id',
        'upline_user_2_id',
        'referred_at',
        'status',
        'user_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function direct_upline()
    {
        return $this->belongsTo(User::class, 'direct_upline_id');
    }

    public function upline_user()
    {
        return $this->belongsTo(User::class, 'upline_user_id');
    }

    public function upline_user_1()
    {
        return $this->belongsTo(User::class, 'upline_user_1_id');
    }

    public function upline_user_2()
    {
        return $this->belongsTo(User::class, 'upline_user_2_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
