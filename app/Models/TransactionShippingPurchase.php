<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TransactionShippingPurchase extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const GATEWAY_STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Failed',
        '3' => 'Success',
    ];

    public const STATUS_SELECT = [
        '1' => 'Failed',
        '2' => 'Success Paid',
        '3' => 'Complete Topup',
    ];

    public $table = 'transaction_shipping_purchases';

    protected $appends = [
        'receipt',
    ];

    protected $dates = [
        'payment_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transaction',
        'user_id',
        'shipping_package_id',
        'point',
        'price',
        'total',
        'payment_method_id',
        'status',
        'payment_verified_at',
        'admin_id',
        'gateway_response',
        'gateway_status',
        'gateway_transaction',
        'invoice_number',
        'receipt_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shipping_package()
    {
        return $this->belongsTo(ShippingPackage::class, 'shipping_package_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function getReceiptAttribute()
    {
        $file = $this->getMedia('receipt')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getPaymentVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setPaymentVerifiedAtAttribute($value)
    {
        $this->attributes['payment_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
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

        if ($request->has('type')){
            $query->when($request['type'] && filled($request['type']), function ($q) use($request) {
                $q->where('type', 'like', "%" . $request['type'] . "%");
            });
        }

        if ($request->has('transaction')){
            $query->when($request['transaction'] && filled($request['transaction']), function ($q) use($request) {
                $q->where('transaction', 'like', "%" . $request['transaction'] . "%");
            });
        }

        if($request->has('user')){
            $query->when($request['user'] && filled($request['user']), function ($q) use($request) {
                $q->whereHas(
                    'user', function($q) use($request){
                    $q->where('name','like', '%'. $request['user']. '%');
                }
                );
            });
        }

        if($request->has('admin')){
            $query->when($request['admin'] && filled($request['admin']), function ($q) use($request) {
                $q->whereHas(
                    'admin', function($q) use($request){
                    $q->where('name','like', '%'. $request['admin']. '%');
                }
                );
            });
        }

        if ($request->has('pg_status')){
            $query->when($request['pg_status'] && filled($request['pg_status']), function ($q) use($request) {
                $q->where('gateway_status', 'like', "%" . $request['pg_status'] . "%");
            });
        }

        if($request->has('shipping_package')){
            $query->when($request['shipping_package'] && filled($request['shipping_package']), function ($q) use($request) {
                $q->whereHas(
                    'shipping_package', function($q) use($request){
                    $q->where('point','like', '%'. $request['shipping_package']. '%');
                }
                );
            });
        }

        if($request->has('start_date')){
            $query->when($request['start_date'] && filled($request['start_date']), function ($q) use($request) {
                $q->where('created_at', '>=', $request['start_date']." 00:00:00");
            });
        }

        if($request->has('end_date')){
            $query->when($request['end_date'] && filled($request['end_date']), function ($q) use($request) {
                $q->where('created_at', '<=', $request['end_date']." 23:59:59");
            });
        }

        return $query;
    }
}
