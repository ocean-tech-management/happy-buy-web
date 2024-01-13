<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionBonu extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Completed',
    ];

    public const TYPE_SELECT = [
        '1' => 'Sponsor',
        '2' => 'Leader',
        '3' => 'Personal',
        '4' => 'Group',
        '5' => 'Special',
    ];

    public $table = 'transaction_bonus';

    protected $dates = [
        'given_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transaction',
        'admin_id',
        'user_id',
        'title',
        'remark',
        'amount',
        'type',
        'status',
        'given_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getGivenAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setGivenAtAttribute($value)
    {
        $this->attributes['given_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
