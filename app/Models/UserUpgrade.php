<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserUpgrade extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Completed',
        '3' => 'Rejected',
    ];

    public const GATEWAY_STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Failed',
        '3' => 'Success',
    ];

    public $table = 'user_upgrades';

    protected $appends = [
        'receipt',
    ];

    protected $dates = [
        'approve_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'upgrade_role_id',
        'amount',
        'payment_method_id',
        'status',
        'gateway_response',
        'gateway_status',
        'gateway_transaction',
        'approve_at',
        'approved_by_user_id',
        'approved_by_admin_id',
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

    public function upgrade_role()
    {
        return $this->belongsTo(Role::class, 'upgrade_role_id');
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

    public function getApproveAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setApproveAtAttribute($value)
    {
        $this->attributes['approve_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function approved_by_user()
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }

    public function approved_by_admin()
    {
        return $this->belongsTo(Admin::class, 'approved_by_admin_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
