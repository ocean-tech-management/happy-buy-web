<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQrLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'product_qr_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'product_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeGenerateProductQr($query, $product_id, $color_id, $size_id)
    {
        $count = ProductQrLog::whereProductId($product_id)->withTrashed()->count();

        $code = str_pad($product_id,7,"0",STR_PAD_LEFT).str_pad($color_id,7,"0",STR_PAD_LEFT).str_pad($size_id,7,"0",STR_PAD_LEFT).str_pad($count+1,7,"0",STR_PAD_LEFT);

        ProductQrLog::create([
            'name' => $code,
            'product_id' => $product_id,
        ]);
        return $code;
    }
}
