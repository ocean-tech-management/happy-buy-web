<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes;
    use Notifiable;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;
    use HasRoles;
    use HasPermissions;

    public $guard_name = 'user';

    public const GENDER_SELECT = [
        '1' => 'Male',
        '2' => 'Female',
    ];

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Inactive',
    ];

    public const USER_TYPE_SELECT = [
        '1' => 'Silver',
        '2' => 'Gold',
        '3' => 'Diamond',
        '4' => 'VIP'
    ];

    public const IDENTITY_TYPE_SELECT = [
        '1' => 'NRIC',
        '2' => 'Passport',
        '3' => 'SSM',
    ];

    public const SSM_VERIFY_SELECT = [
        '1' => 'Not Yet',
        '2' => 'Verified',
    ];

    public const SHOP_VERIFY_SELECT = [
        '1' => 'Not Yet',
        '2' => 'Verified',
    ];

    public const FIRST_PAYMENT_SELECT = [
        '1' => 'Not Yet',
        '2' => 'Verified',
    ];

    public const ACCOUNT_VERIFY_SELECT = [
        '1' => 'Not Yet',
        '2' => 'Verified',
    ];

    public const NEW_SIGN_REQUIRE_SELECT = [
        '1' => 'No',
        '2' => 'Yes',
        '3' => 'Signed',
    ];

    public const B2B_SIGN_REQUIRE_SELECT = [
        '1' => 'No',
        '2' => 'Yes',
        '3' => 'Signed',
    ];

    // When Blocked, User cannot make order and top up.
    public const ALLOW_ORDER_STATUS_SELECT = [
        '1' => 'Allow',
        '2' => 'Blocked',
    ];

    public const SUB_USER_TYPE_SELECT = [
        '1' => 'None',
        '2' => 'Millionaire Leader', // If Millionaire Leader who have qualify to get team car and team house bonus.
    ];

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $appends = [
        'profile_photo',
        'ssm_photo',
        'ic_photo',
        'shop_photo',
        'first_payment_receipt_photo',
    ];

    protected $dates = [
        'date_of_birth',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'password',
        'identity_type',
        'identity_no',
        'phone',
        'email',
        'date_of_birth',
        'gender',
        'bank_list_id',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'country_id',
        'user_type',
        'personal_code',
        'direct_upline_id',
        'upline_user_id',
        'upline_user_1_id',
        'upline_user_2_id',
        'status',
        'account_verify',
        'ssm_verify',
        'shop_verify',
        'first_payment',
        'new_sign_required',
        'b2b_sign_required',
        'allow_order_status',
        'sub_user_type',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'sub_user_type_at',
        'upgraded_at',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function bank_list()
    {
        return $this->belongsTo(BankList::class, 'bank_list_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function direct_upline()
    {
        return $this->belongsTo(User::class, 'direct_upline_id');
    }

    public function upline_user()
    {
        return $this->belongsTo(User::class, 'upline_user_id');
    }

    public function upline_user_1()
    {
        return $this->belongsTo(User::class, 'upline_user_1_id');
    }

    public function upline_user_2()
    {
        return $this->belongsTo(User::class, 'upline_user_2_id');
    }

    public function address_book()
    {
        return $this->hasMany(AddressBook::class, 'user_id');
    }

    public function agreement()
    {
        return $this->hasMany(UserAgreementLog::class, 'user_id');
    }

    public function getProfilePhotoAttribute()
    {
        $file = $this->getMedia('profile_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getSsmPhotoAttribute()
    {
        $file = $this->getMedia('ssm_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getIcPhotoAttribute()
    {
        $file = $this->getMedia('ic_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getFirstPaymentReceiptPhotoAttribute()
    {
        $file = $this->getMedia('first_payment_receipt_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getShopPhotoAttribute()
    {
        $file = $this->getMedia('shop_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }


    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function hasOTPVerified()
    {
        return $this->register_verify_at != NULL;
    }

    public function point(){
        return Point::where('user_id', $this->id)->first();
    }

//    public function roles()
//    {
//        return $this->belongsToMany(Role::class);
//    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {
        $query->when($request['role'] && filled($request['role']), function ($q) use($request) {
            $q->whereHas(
                'roles', function($q) use($request){
                    $q->where('name','like', '%'.$request['role'].'%');
                }
            );
        });

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

        if ($request->has('email')){
            $query->when($request['email'] && filled($request['email']), function($q) use($request){
                $q->where('email', 'like', '%'. $request['email'] . '%');
            });
        };

        if ($request->has('identity_no')){
            $query->when($request['identity_no'] && filled($request['identity_no']), function($q) use($request){
                $q->where('identity_no', 'like', '%'. $request['identity_no'] . '%');
            });
        };

        if ($request->has('gender')){
            $query->when($request['gender'] && filled($request['gender']), function($q) use($request){
                $q->where('gender', 'like', '%'. $request['gender'] . '%');
            });
        };

        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function($q) use($request){
                $q->where('status', 'like', '%'. $request['status'] . '%');
            });
        };

        if ($request->has('user_type')){
            $query->when($request['user_type'] && filled($request['user_type']), function($q) use($request){
                $q->where('user_type', 'like', '%'. $request['user_type'] . '%');
            });
        };

        if ($request->has('allow_order_status')){
            $query->when($request['allow_order_status'] && filled($request['allow_order_status']), function($q) use($request){
                $q->where('allow_order_status', 'like', '%'. $request['allow_order_status'] . '%');
            });
        };


        return $query;
    }
}
