<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserEntry extends Model implements HasMedia
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
        '2' => 'Pending Verify',
        '3' => 'Complete Topup',
    ];

    public const USER_TYPE_SELECT = [
        '1' => 'Silver',
        '2' => 'Gold',
        '3' => 'Diamond',
        '4' => 'VIP',
    ];

    public $table = 'user_entries';

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
        'user_id',
        'transaction',
        'user_type',
        'deposit',
        'fee',
        'top_up',
        'payment_method_id',
        'status',
        'payment_verified_at',
        'gateway_response',
        'gateway_status',
        'gateway_transaction',
        'invoice_number',
        'receipt_number',
        'new_invoice_number',
        'new_receipt_number',
        'total',
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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

        if($request->has('transaction')){
            $query->when($request['transaction'] && filled($request['transaction']), function ($q) use($request) {
                $q->where('transaction','like', '%'. $request['transaction']. '%');
            });
        }

        if($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function ($q) use($request) {
                $q->where('status', '=', $request['status']);
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

        // if($request->has('date')) {
        //     $query->when($request['date'] && filled($request['date']), function ($q) use($request) {
        //         $q->whereDate('created_at', '=', $request['date']);
        //     });
        // }

        return $query;
    }
}
