<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositBank extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Inactive',
    ];

    public $table = 'deposit_banks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bank_id',
        'bank_account_name',
        'bank_account_number',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bank()
    {
        return $this->belongsTo(BankList::class, 'bank_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {        
        if ($request->has('name')){
            $query->when($request['name'] && filled($request['name']), function($q) use($request){
                $q->where('bank_account_name', 'like', '%'. $request['name'] . '%');
            });
        };            
        
        if($request->has('bank')){
            $query->when($request['bank'] && filled($request['bank']), function ($q) use($request) {
                $q->whereHas(
                    'bank', function($q) use($request){
                        $q->where('code','like', '%'. $request['bank']. '%');
                    }
                );
            });
        };    

        if ($request->has('number')){
            $query->when($request['number'] && filled($request['number']), function($q) use($request){
                $q->where('bank_account_number', 'like', '%'. $request['number'] . '%');
            });
        };

        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function($q) use($request){
                $q->where('status', 'like', '%'. $request['status'] . '%');
            });
        };

        return $query;
    }
}
