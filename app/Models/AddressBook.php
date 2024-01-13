<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressBook extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const SET_DEFAULT_SELECT = [
        '1' => 'Yes',
        '2' => 'No',
    ];

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Inactive',
    ];

    public $table = 'address_books';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'remark',
        'name',
        'phone',
        'address_1',
        'address_2',
        'city',
        'state_id',
        'postcode',
        'set_default',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {           
        if($request->has('uname')){
            $query->when($request['uname'] && filled($request['uname']), function ($q) use($request) {
                $q->whereHas(
                    'user', function($q) use($request){
                        $q->where('name','like', '%'. $request['uname']. '%');
                    }
                );
            });
        };     

        if ($request->has('name')){
            $query->when($request['name'] && filled($request['name']), function($q) use($request){
                $q->where('name', 'like', '%'. $request['name'] . '%');
            });
        };

        if ($request->has('phone')){
            $query->when($request['phone'] && filled($request['phone']), function($q) use($request){
                $q->where('phone', 'like', '%'. $request['phone'] . '%');
            });
        };

        if ($request->has('city')){
            $query->when($request['city'] && filled($request['city']), function($q) use($request){
                $q->where('city', 'like', '%'. $request['city'] . '%');
            });
        };

        if ($request->has('state')){
            $query->when($request['state'] && filled($request['state']), function($q) use($request){
                $q->where('state', 'like', '%'. $request['state'] . '%');
            });
        };

        if ($request->has('postcode')){
            $query->when($request['postcode'] && filled($request['postcode']), function($q) use($request){
                $q->where('postcode', 'like', '%'. $request['postcode'] . '%');
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
