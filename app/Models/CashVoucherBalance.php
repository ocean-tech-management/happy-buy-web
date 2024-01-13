<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashVoucherBalance extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Success',
        '2' => 'Cancelled',
    ];

    public const SETTLEMENT_SELECT = [
        '1' => 'Pending',
        '2' => 'Success',
    ];

    public $table = 'cash_voucher_balances';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'settlement',
        'remark',
        'model_type',
        'model',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {
        if($request->has('user')){
            $query->when($request['user'] && filled($request['user']), function ($q) use($request) {
                $q->whereHas(
                    'user', function($q) use($request){
                        $q->where('name','like', '%'. $request['user']. '%');
                    }
                );
            });
        };

        if ($request->has('amount')){
            $query->when($request['amount'] && filled($request['amount']), function($q) use($request){
                $q->where('amount', 'like', '%'. $request['amount'] . '%');
            });
        };

        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function($q) use($request){
                $q->whereStatus($request['status']);
            });
        };

        if ($request->has('settlement')){
            $query->when($request['settlement'] && filled($request['settlement']), function($q) use($request){
                $q->where('settlement', 'like', '%'. $request['settlement'] . '%');
            });
        };

        if ($request->has('remark')){
            $query->when($request['remark'] && filled($request['remark']), function($q) use($request){
                $q->where('remark', 'like', '%'. $request['remark'] . '%');
            });
        };

        if ($request->has('start_date')){
            $query->when($request['start_date'] && filled($request['start_date']), function($q) use($request){
                $q->whereDate('created_at', '>=',  $request['start_date']);
            });
        };

        if ($request->has('end_date')){
            $query->when($request['end_date'] && filled($request['end_date']), function($q) use($request){
                $q->whereDate('updated_at', '<=',  $request['end_date']);
            });
        };

        return $query;
    }
}
