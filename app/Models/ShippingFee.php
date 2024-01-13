<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingFee extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Inactive',
    ];

    public $table = 'shipping_fees';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'add_on',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function states()
    {
        return $this->belongsToMany(State::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('name')){
            $query->when($request['name'] && filled($request['name']), function($q) use($request){
                $q->where('name', 'like', '%'. $request['name'] . '%');
            });
        };

        if($request->has('state')){
            $query->when($request['state'] && filled($request['state']), function ($q) use($request) {
                $q->whereHas(
                    'states', function($q) use($request){
                        $q->where('name','like', '%'. $request['state']. '%');
                    }
                );
            });
        };

        return $query;
    }
}
