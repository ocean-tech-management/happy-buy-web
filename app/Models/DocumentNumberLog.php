<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentNumberLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        '1' => 'Invoice',
        '2' => 'Receipt',
        '3' => 'Payment Voucher',
    ];

    public $table = 'document_number_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'name',
        'user_id',
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

    public function scopeGenerateDocumentNumber($query, $type, $user_id)
    {
        if($type == 1){
            $prefix = "INV";
        }else if($type == 2){
            $prefix = "RECEIPT";
        }else if($type == 3){
            $prefix = "PAYMENT";
        }else{
            $prefix = "INV";
        }

        $count = DocumentNumberLog::count();
        $currentYear = Carbon::now()->format('y');

        do {
            $key = $prefix."-".str_pad($count + 1,7,"0",STR_PAD_LEFT)."/".$currentYear;
            $check = DocumentNumberLog::where('name', $key)->count();
        } while ($check >= 1);

        DocumentNumberLog::create(['name' => $key, 'type' => $type, 'user_id' => $user_id]);

        return $key;
    }
}
