<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class TransactionRedeemProduct extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const COLLECT_TYPE_SELECT = [
        '1' => 'Pickup',
        '2' => 'Delivery',
    ];

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Shipped',
        '3' => 'Completed',
        '4' => 'Cancelled',
    ];

    public $table = 'transaction_redeem_products';

    protected $dates = [
        'refund_at',
        'pickup_at',
        'shipout_at',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transaction',
        'product_id',
        'variant_id',
        'user_id',
        'product_name',
        'purchase_price',
        'purchase_color',
        'purchase_size',
        'purchase_quantity',
        'pre_point_balance',
        'post_point_balance',
        'status',
        'collect_type',
        'address_id',
        'shipped_by_id',
        'picked_up_by_id',
        'completed_by_id',
        'refund_by_id',
        'shipping_company_id',
        'tracking_code',
        'refund_at',
        'pickup_at',
        'shipout_at',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(AddressBook::class, 'address_id');
    }

    public function shipped_by()
    {
        return $this->belongsTo(Admin::class, 'shipped_by_id');
    }

    public function picked_up_by()
    {
        return $this->belongsTo(Admin::class, 'picked_up_by_id');
    }

    public function completed_by()
    {
        return $this->belongsTo(Admin::class, 'completed_by_id');
    }

    public function refund_by()
    {
        return $this->belongsTo(Admin::class, 'refund_by_id');
    }

    public function shipping_company()
    {
        return $this->belongsTo(ShippingCompany::class, 'shipping_company_id');
    }

    public function getRefundAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setRefundAtAttribute($value)
    {
        $this->attributes['refund_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPickupAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPickupAtAttribute($value)
    {
        $this->attributes['pickup_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getShipoutAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setShipoutAtAttribute($value)
    {
        $this->attributes['shipout_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getCompletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setCompletedAtAttribute($value)
    {
        $this->attributes['completed_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, Request $request)
    {
        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function ($q) use($request) {
                $q->where('status', 'like', "%" . $request['status'] . "%");
            });
        }

        if ($request->has('collect_type')){
            $query->when($request['collect_type'] && filled($request['collect_type']), function($q) use($request){
                $q->where('collect_type', 'like', '%'. $request['collect_type'] . '%');
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

        return $query;
    }
}
