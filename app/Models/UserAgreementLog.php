<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAgreementLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'user_agreement_logs';

    protected $dates = [
        'signature_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_agreement_id',
        'user_id',
        'signature_name',
        'signature_ic',
        'signature_at',
        'remark',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user_agreement()
    {
        return $this->belongsTo(UserAgreement::class, 'user_agreement_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSignatureAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setSignatureAtAttribute($value)
    {
        $this->attributes['signature_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('user')){
            $query->when($request['user'] && filled($request['user']), function($q) use($request){
                $q->whereHas('user', function($q) use ($request) {
                    $q->where('name', 'LIKE', '%'. $request['user'] . '%');
                });
            });
        };

        if ($request->has('signature_name')){
            $query->when($request['signature_name'] && filled($request['signature_name']), function($q) use($request){
                $q->where('signature_name', 'LIKE', '%'. $request['signature_name'] . '%');
            });
        };

        if ($request->has('signature_ic')){
            $query->when($request['signature_ic'] && filled($request['signature_ic']), function($q) use($request){
                $q->where('signature_ic', 'LIKE', '%'. $request['signature_ic'] . '%');
            });
        };

        if ($request->has('start_date')){
            $query->when($request['start_date'] && filled($request['start_date']), function($q) use($request){
                $q->whereDate('signature_at', '>=',  $request['start_date']);
            });
        };

        if ($request->has('end_date')){
            $query->when($request['end_date'] && filled($request['end_date']), function($q) use($request){
                $q->whereDate('signature_at', '<=',  $request['end_date']);
            });
        };

        return $query;
    }
}
