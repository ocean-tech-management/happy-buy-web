<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class DocumentMBRInvoiceLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'document_mbr_invoice_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        // 'order_id',
        'amount',
        'quantity',
        'unit_price',
        'user_id',
        'from_user_id',
        'method',
        'remark',
        'payment_remark',
        'order_name',
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

    public function scopeGenerateDocumentNumber($query, $user_id, $from_user_id = null, $year = null, $amount = null, $quantity = null, $unit_price = null)
    {
        $prefix = "INV";

        $count = DocumentMBRInvoiceLog::whereNotNull('name')->groupBy('name')->get()->count();
        $currentYear = ($year != null) ? $year : Carbon::now()->format('y');

        $from_user_id = 1;
        $first_number = 1;

        if($amount == null) {
            $amount = 0;
        }

        if($quantity == null) {
            $quantity = 0;
        }

        if($unit_price == null) {
            $unit_price = 90;
        }

        $value = $amount/$unit_price;

        if (strpos($value,'.') !== false) {
            DocumentMBRInvoiceLog::create(['amount' => $amount, 'quantity' => 0, 'unit_price' => $unit_price, 'user_id' => $user_id, 'from_user_id' => $from_user_id]);

            return "";
        }else {
//            do {
                if($count >= (9999999 * $first_number)) {
                    $first_number++;
                }

                $key = $prefix."-".$first_number.str_pad($count + 1,7,"0",STR_PAD_LEFT)."/".$currentYear;
//                $check = DocumentMBRInvoiceLog::where('name', $key)->count();
//            } while ($check >= 1);

            DocumentMBRInvoiceLog::create(['name' => $key, 'amount' => $amount, 'quantity' => $value, 'unit_price' => $unit_price, 'user_id' => $user_id, 'from_user_id' => $from_user_id]);

            return $key;

        }

//        return $key;
    }

    public function scopeGenerateDocumentNumber2($query, $user_id, $from_user_id = null, $year = null, $amount = null, $quantity = null, $unit_price = null, $created_at = null)
    {
        $prefix = "INV";

        $count = DocumentMBRInvoiceLog::whereNotNull('name')->groupBy('name')->get()->count();
        $currentYear = ($year != null) ? $year : Carbon::now()->format('y');

        $from_user_id = 1;
        $first_number = 1;

        if($amount == null) {
            $amount = 0;
        }

        if($quantity == null) {
            $quantity = 0;
        }

        if($unit_price == null) {
            $unit_price = 90;
        }

        $value = $amount/$unit_price;

        if (strpos($value,'.') !== false) {
            DocumentMBRInvoiceLog::create(['amount' => $amount, 'quantity' => 0, 'unit_price' => $unit_price, 'user_id' => $user_id, 'from_user_id' => $from_user_id, 'created_at' => $created_at]);

            return "";
        }else {
//            do {
            if($count >= (9999999 * $first_number)) {
                $first_number++;
            }

            $key = $prefix."-".$first_number.str_pad($count + 1,7,"0",STR_PAD_LEFT)."/".$currentYear;
//                $check = DocumentMBRInvoiceLog::where('name', $key)->count();
//            } while ($check >= 1);

            DocumentMBRInvoiceLog::create(['name' => $key, 'amount' => $amount, 'quantity' => $value, 'unit_price' => $unit_price, 'user_id' => $user_id, 'from_user_id' => $from_user_id, 'created_at' => $created_at]);

            return $key;

        }

//        return $key;
    }

}
