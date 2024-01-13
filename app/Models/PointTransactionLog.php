<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointTransactionLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'point_transaction_logs';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'date',
        'top_up',
        'point_convert',
        'redemption',
        'shipping',
        'cash_voucher',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
                        $q->where('id', $request['user']);
                    }
                );
            });
        }

        if ($request->has('start_date')){
            $query->when($request['start_date'] && filled($request['start_date']), function($q) use($request){
                $q->whereDate('date', '>=',  $request['start_date']);
            });
        };

        if ($request->has('end_date')){
            $query->when($request['end_date'] && filled($request['end_date']), function($q) use($request){
                $q->whereDate('date', '<=',  $request['end_date']);
            });
        };

        return $query;
    }
}
