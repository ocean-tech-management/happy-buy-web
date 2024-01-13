<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BonusFirstUplineLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Success',
        '2' => 'On Hold',
        '3' => 'Failed', // Only Type 2, will occur when reach expired days.
    ];

    public const TYPE_SELECT = [
        '1' => 'First Upline Bonus', // Refer Transaction Bonus Given 6
        '2' => 'First Upline Extra Bonus', // Refer Transaction Bonus Given 7
        '3' => 'User Upgrade First Upline Bonus',
    ];
    
    public $table = 'bonus_first_upline_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'level',
        'transaction_remark',
        'remark',
        'amount',
        'type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
