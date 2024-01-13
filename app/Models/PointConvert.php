<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointConvert extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'point_converts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transaction',
        'user_id',
        'amount',
        'pre_cp_bonus_balance',
        'post_cp_bonus_balance',
        'pre_cp_balance',
        'post_cp_balance',
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
        if ($request->has('transaction')){
            $query->when($request['transaction'] && filled($request['transaction']), function ($q) use($request) {
                $q->where('transaction', 'like', "%" . $request['transaction'] . "%");
            });
        };       

        if($request->has('user')){
            $query->when($request['user'] && filled($request['user']), function ($q) use($request) {
                $q->whereHas(
                    'user', function($q) use($request){
                        $q->where('name','like', '%'. $request['user']. '%');
                    });
            });
        }; 
        
        // if ($request->has('amount')){
        //     $query->when($request['amount'] && filled($request['amount']), function ($q) use($request) {
        //         $q->where('amount', 'like', "%" . $request['amount'] . "%");
        //     });
        // };

        return $query;
    }
}
