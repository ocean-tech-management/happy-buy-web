<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Order extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const COLLECT_TYPE_SELECT = [
        '1' => 'Pickup',
        '2' => 'Delivery',
    ];

    public const WALLET_TYPE_SELECT = [
        '1' => 'Executive',
        '2' => 'Manager',
        '3' => 'Millionaire',
        '4' => 'Cash Voucher',
        '5' => 'PV',
    ];

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Shipped',
        '3' => 'Picked Up',
        '4' => 'Cancelled',
        '5' => 'Completed',
    ];

    public $table = 'orders';

    protected $dates = [
        'shipout_at',
        'pickup_at',
        'completed_at',
        'refund_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'cart_id',
        'order_number',
        'amount',
        'voucher_amount',
        'cash_voucher_amount',
        'wallet_type',
        'sub_total',
        'total_add_on',
        'total_shipping',
        'payment_method_id',
        'receiver_name',
        'receiver_phone',
        'receiver_address_1',
        'receiver_address_2',
        'receiver_city',
        'receiver_state',
        'receiver_postcode',
        'billing_name',
        'billing_phone',
        'billing_address',
        'pre_point_balance',
        'post_point_balance',
        'collect_type',
        'order_type',
        'shipped_by_id',
        'picked_up_by_id',
        'completed_by_id',
        'refund_by_id',
        'shipping_company_id',
        'tracking_code',
        'shipout_at',
        'pickup_at',
        'pickup_location_id',
        'completed_at',
        'refund_at',
        'status',
        'remark',
        'invoice_number',
        'invoice_user_id',
        'order_user_id',
        'new_invoice_number',
        'shipping_invoice_user_id',
        'credit_note_number',
        'shipping_invoice_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function pickup_location()
    {
        return $this->belongsTo(PickUpLocation::class, 'pickup_location_id');
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

    public function order_item()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function invoice_user()
    {
        return $this->belongsTo(User::class, 'invoice_user_id');
    }

    public function order_user()
    {
        return $this->belongsTo(User::class, 'order_user_id');
    }

    public function getShipoutAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setShipoutAtAttribute($value)
    {
        $this->attributes['shipout_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPickupAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPickupAtAttribute($value)
    {
        $this->attributes['pickup_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getCompletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setCompletedAtAttribute($value)
    {
        $this->attributes['completed_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getRefundAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setRefundAtAttribute($value)
    {
        $this->attributes['refund_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
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

        if ($request->has('order_number')){
            $query->when($request['order_number'] && filled($request['order_number']), function($q) use($request){
                $q->where('order_number', 'like', '%'. $request['order_number'] . '%');
            });
        };

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
