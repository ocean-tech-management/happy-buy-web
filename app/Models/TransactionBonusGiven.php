<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionBonusGiven extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Completed',
    ];

    public const TYPE_SELECT = [
        '1' => 'Referral',
        '2' => 'Personal Top Up Bonus',
        '3' => 'Team Top Up Bonus',
        '4' => 'Personal Annual Bonus',
        '5' => 'Team Annual Bonus',

        '6' => 'First Upline Bonus',
        '7' => 'First Upline Extra Bonus',
        '8' => 'Team Car Bonus',
        '9' => 'Team House Bonus',
        '10' => 'Second Upline Bonus',
        '11' => 'User Upgrade First Upline Bonus',
        '12' => 'User Upgrade Second Upline Bonus',
    ];

    public $table = 'transaction_bonus_givens';

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
        'model_type',
        'model',
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

    public function scopeSearch($query, $request)
    {
        if ($request->has('type')){
            $query->when($request['type'] && filled($request['type']), function($q) use($request){
                $q->where('type', 'like', '%'. $request['type'] . '%');
            });
        };

        if ($request->has('transaction')){
            $query->when($request['transaction'] && filled($request['transaction']), function($q) use($request){
                $q->where('transaction', 'like', '%'. $request['transaction'] . '%');
            });
        };

        if($request->has('admin')){
            $query->when($request['admin'] && filled($request['admin']), function ($q) use($request) {
                $q->whereHas(
                    'admin', function($q) use($request){
                        $q->where('name','like', '%'. $request['admin']. '%');
                    }
                );
            });
        };

        if($request->has('user')){
            $query->when($request['user'] && filled($request['user']), function ($q) use($request) {
                $q->whereHas(
                    'user', function($q) use($request){
                        $q->where('name','like', '%'. $request['user']. '%');
                    }
                );
            });
        };

        if ($request->has('title')){
            $query->when($request['title'] && filled($request['title']), function($q) use($request){
                $q->where('title', 'like', '%'. $request['title'] . '%');
            });
        };

        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function($q) use($request){
                $q->where('status', 'like', '%'. $request['status'] . '%');
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
