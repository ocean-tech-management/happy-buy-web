<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Checkout',
    ];

    public const TYPE_SELECT = [
        '1' => 'Sales',
        '2' => 'Free',
    ];

    public $table = 'carts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'product_id',
        'product_variant_id',
        'to_user_id',
        'admin_id',
        'quantity',
        'status',
        'type',
        'is_package',
        'package_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function package_item()
    {
        return $this->hasMany(Cart::class, 'package_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function ($q) use($request) {
                $q->where('carts.status', 'like', "%" . $request['status'] . "%");
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

        if($request->has('product')){
            $query->when($request['product'] && filled($request['product']), function ($q) use($request) {
                $q->whereHas(
                    'product', function($q) use($request){
                        $q->where('name_en','like', '%'. $request['product']. '%');
                    });
            });
        };

        return $query;
    }
}
