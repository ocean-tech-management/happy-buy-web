<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBatch extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Generate',
        '2' => 'In Stock',
    ];

    public $table = 'product_batches';

    protected $appends = [
      'various_in_stock_by',
    ];

    protected $dates = [
        'generated_at',
        'in_stock_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'remark',
        'status',
        'product_id',
        'product_variant_id',
        'quantity',
        'generated_at',
        'in_stock_at',
        'created_by_id',
        'in_stock_by_id',
        'cost_price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function product_quantity()
    {
        return $this->hasMany(ProductQuantity::class, 'batch_id');
    }

    public function created_by()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }

    public function in_stock_by()
    {
        return $this->belongsTo(Admin::class, 'in_stock_by_id');
    }

    public function filter_product_quantity()
    {
        return $this->hasMany(ProductQuantity::class, 'batch_id')->groupBy('in_stock_by_id');
    }

    public function getVariousInStockByAttribute()
    {

        $various_in_stock_by = "";
        foreach ($this->filter_product_quantity as $item) {
            if($this->in_stock_by != null){
                if($item->in_stock_by != null){
                    if($this->in_stock_by->name != $item->in_stock_by->name){
                        $various_in_stock_by .= $item->in_stock_by->name.", ";
                    }
                }else{
                    $various_in_stock_by .= $this->in_stock_by->name.", ";
                }
            }else{
                if($item->in_stock_by != null){
                    $various_in_stock_by .= $item->in_stock_by->name.", ";
                }
            }
        }

        if($this->in_stock_by != null){
            $various_in_stock_by = $this->in_stock_by->name.", ".$various_in_stock_by;
        }


        return rtrim($various_in_stock_by, ', ');
    }

    public function getGeneratedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setGeneratedAtAttribute($value)
    {
        $this->attributes['generated_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getInStockAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setInStockAtAttribute($value)
    {
        $this->attributes['in_stock_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('batch_name')){
            $query->when($request['batch_name'] && filled($request['batch_name']), function($q) use($request){
                $q->where('name', 'like', '%'. $request['batch_name'] . '%');
            });
        };

        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function($q) use($request){
                $q->where('status', 'like', '%'. $request['status'] . '%');
            });
        };

        if($request->has('product')){
            $query->when($request['product'] && filled($request['product']), function ($q) use($request) {
                $q->whereHas(
                    'product', function($q) use($request){
                    $q->where('name_en','like', '%'. $request['product']. '%');
                }
                );
            });
        };

        if($request->has('product_variant')){
            $query->when($request['product_variant'] && filled($request['product_variant']), function ($q) use($request) {
                $q->whereHas(
                    'product_variant', function($q) use($request){
                    $q->where('sku','like', '%'. $request['product_variant']. '%');
                }
                );
            });
        };

        return $query;
    }
}
