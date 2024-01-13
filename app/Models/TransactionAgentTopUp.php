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

class TransactionAgentTopUp extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        '1' => 'Top Up',
        '2' => 'Upgrade',
    ];

    public const TO_WALLET_SELECT = [
        '1' => 'Executive',
        '2' => 'Manager',
        '3' => 'Millionaire',
    ];

    public const FROM_WALLET_SELECT = [
        '1' => 'Executive',
        '2' => 'Manager',
        '3' => 'Millionaire',
    ];

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Approved',
        '3' => 'Rejected',
    ];

    public $table = 'transaction_agent_top_ups';

    protected $appends = [
        'receipt_photo',
    ];

    protected $dates = [
        'approved_at',
        'rejected_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transaction',
        'user_id',
        'merchant_id',
        'amount',
        'type',
        'from_wallet',
        'to_wallet',
        'deposit_bank',
        'deposit_bank_account_name',
        'deposit_bank_account_number',
        'merchant_pre_balance',
        'merchant_post_balance',
        'user_pre_balance',
        'user_post_balance',
        'point_package_id',
        'status',
        'approved_at',
        'rejected_at',
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

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function point_package()
    {
        return $this->belongsTo(PointPackage::class, 'point_package_id');
    }

    public function getReceiptPhotoAttribute()
    {
        $file = $this->getMedia('receipt_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getApprovedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setApprovedAtAttribute($value)
    {
        $this->attributes['approved_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getRejectedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setRejectedAtAttribute($value)
    {
        $this->attributes['rejected_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
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

        if($request->has('merchant')){
            $query->when($request['merchant'] && filled($request['merchant']), function ($q) use($request) {
                $q->whereHas(
                    'merchant', function($q) use($request){
                        $q->where('name','like', '%'. $request['merchant']. '%');
                    }
                );
            });
        }


        return $query;
    }
}
