<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentPaymentVoucherLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'document_payment_voucher_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'user_id',
        'from_user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeGenerateDocumentNumber($query, $user_id, $from_user_id = null, $year = null)
    {
        $prefix = "PV";

        $count = DocumentPaymentVoucherLog::count();
        $currentYear = ($year != null) ? $year : Carbon::now()->format('y');

        // if(!$from_user_id) {
        //     $from_user = User::where('id', $user_id)->first();
        //     if($from_user) {
        //         $from_user_id = ($from_user->upline_user_id != null) ? $from_user->upline_user_id : 1;
        //     } else {
        //         $from_user_id = 1;
        //     }
        // }
        $from_user_id = 1;

        do {
            $key = $prefix."-".str_pad($count + 1,8,"0",STR_PAD_LEFT)."/".$currentYear;
            $check = DocumentPaymentVoucherLog::where('name', $key)->count();
        } while ($check >= 1);

        DocumentPaymentVoucherLog::create(['name' => $key, 'user_id' => $user_id, 'from_user_id' => $from_user_id]);

        return $key;
    }
}
