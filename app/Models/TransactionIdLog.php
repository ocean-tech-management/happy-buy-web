<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionIdLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        '1' => 'BP', //buy point
        '2' => 'RP', //redeem product
        '3' => 'WC', //withdraw cash
        '4' => 'GB', //give bonus
        '5' => 'CP', //convert point
        '6' => 'SP', //buy shipping point
        '7' => 'UA', //buy shipping point
    ];

    public const TYPE_SELECT_2 = [
        '1' => 'P',
        '2' => 'R',
        '3' => 'W',
        '4' => 'B',
        '5' => 'C',
        '6' => 'S',
        '7' => 'U',
    ];

    public $table = 'transaction_id_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'name',
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

    public function scopeGenerateTransactionId($query, $type, $user_id, $model_id)
    {
        $type_name = self::TYPE_SELECT[$type];
        $type_name2 = self::TYPE_SELECT_2[$type];

        do {
            $key = "ERYA".$type_name.date('YmdHis').$type_name2.$model_id;
            $check = TransactionIdLog::where('name', $key)->count();
        } while ($check >= 1);

        TransactionIdLog::create(['name' => $key, 'type' => $type, 'user_id' => $user_id]);

        return $key;
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('type')){
            $query->when($request['type'] && filled($request['type']), function($q) use($request){
                $q->where('type', $request['type']);
            });
        };

        if ($request->has('name')){
            $query->when($request['name'] && filled($request['name']), function($q) use($request){
                $q->where('name', 'like', '%'. $request['name'] . '%');
            });
        };

        if($request->has('user')){
            $query->when($request['user'] && filled($request['user']), function ($q) use($request) {
                $q->whereHas(
                    'user', function($q) use($request){
                        $q->where('id', $request['user']);
                    }
                );
            });
        }

        return $query;
    }

//    function generate($length)
//    {
//        $pool = array_merge(range(2, 9), range('a', 'h'), range('j', 'k'), range('m', 'n'), range('p', 'z'), range(2, 9));
//
//        $key = "";
//
//        for ($i = 0; $i < $length; $i++) {
//            $key .= $pool[mt_rand(0, count($pool) - 1)];
//        }
//
//        return strtoupper($key);
//    }
}
