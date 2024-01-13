<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TransactionPointWithdraw extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Success',
        '3' => 'Rejected',
        '4' => 'Processing',
    ];

    public $table = 'transaction_point_withdraws';

    protected $appends = [
        'receipt',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transaction',
        'user_id',
        'amount',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'status',
        'admin_id',
        'remark',
        'payment_voucher_number',
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

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, Request $request)
    {
        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function ($q) use($request) {
                $q->where('status', $request['status']);
            });
        };

        if ($request->has('transaction')){
            $query->when($request['transaction'] && filled($request['transaction']), function ($q) use($request) {
                $q->where('transaction', 'like', "%" . $request['transaction'] . "%");
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

        if ($request->has('ba_name')){
            $query->when($request['ba_name'] && filled($request['ba_name']), function ($q) use($request) {
                $q->where('bank_account_name', 'like', "%" . $request['ba_name'] . "%");
            });
        };

        if ($request->has('ba_number')){
            $query->when($request['ba_number'] && filled($request['ba_number']), function ($q) use($request) {
                $q->where('bank_account_number', 'like', "%" . $request['ba_number'] . "%");
            });
        };


        return $query;
    }
}
