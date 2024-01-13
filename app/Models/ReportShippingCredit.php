<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportShippingCredit extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'report_shipping_credits';

    protected $dates = [
        'transaction_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $fillable = [
        'transaction_date',
        'document_no',
        'description',
        'amount',
        'total',
        'from_table',
        'from_table_id',
        'user_id',
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

    public function scopeSearch($query, Request $request)
    {
        if($request->has('user')){
            $query->when($request['user'] && filled($request['user']), function ($q) use($request) {
                $q->whereHas(
                    'user', function($q) use($request){
                    $q->where('name','like', '%'. $request['user']. '%');
                }
                );
            });
        }

        if($request->has('start_date')){
            $query->when($request['start_date'] && filled($request['start_date']), function ($q) use($request) {
                $q->where('transaction_date', '>=', $request['start_date']." 00:00:00");
            });
        }

        if($request->has('end_date')){
            $query->when($request['end_date'] && filled($request['end_date']), function ($q) use($request) {
                $q->where('transaction_date', '<=', $request['end_date']." 23:59:59");
            });
        }

        return $query;
    }
}
