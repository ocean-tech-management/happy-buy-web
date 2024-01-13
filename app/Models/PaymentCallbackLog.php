<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCallbackLog extends Model
{

    public $table = 'payment_callback_log';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'transaction',
        'remark',
        'callback_data',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
