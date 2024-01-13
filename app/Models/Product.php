<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Inactive',
    ];

    public const TYPE_SELECT = [
        '1' => 'Individual Item',
        '2' => 'Package Item',
    ];

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
    ];

    protected $fillable = [
        'name_en',
        'name_zh',
        'short_desc_en',
        'short_desc_zh',
        'desc_en',
        'desc_zh',
        'category_id',
        'parent_id',
        'status',
        'type',
        'product_variant_quantity',
        'product_variant_item_quantity',
        'free_quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getImage1Attribute()
    {
        $file = $this->getMedia('image_1')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getImage2Attribute()
    {
        $file = $this->getMedia('image_2')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getImage3Attribute()
    {
        $file = $this->getMedia('image_3')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getImage4Attribute()
    {
        $file = $this->getMedia('image_4')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getImage5Attribute()
    {
        $file = $this->getMedia('image_5')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function variant()
    {
        return $this->hasMany(ProductVariant::class, 'product_id')->orderBy('color_id', 'asc');
    }

    public function product_list()
    {
        return $this->belongsToMany(Product::class, 'product_product_list', 'product_list_id');
    }

    public function child_list()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    public function parent_product()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getNameAttribute(){
        if (App::isLocale('en')) {
            return $this->name_en;
        }else{
            return $this->name_zh;
        }
    }

    public function scopeSearch($query, $request)
    {
        if ($request->has('name')){
            $query->when($request['name'] && filled($request['name']), function($q) use($request){
                $q->where('name_en', 'like', '%'. $request['name'] . '%')
                ->orWhere('name_zh', 'like', '%'. $request['name'] . '%');
            });
        };

        if ($request->has('status')){
            $query->when($request['status'] && filled($request['status']), function($q) use($request){
                $q->where('status', 'like', '%'. $request['status'] . '%');
            });
        };

        if($request->has('category')){
            $query->when($request['category'] && filled($request['category']), function ($q) use($request) {
                $q->whereHas(
                    'category', function($q) use($request){
                        $q->where('name_en','like', '%'. $request['category']. '%');
                    }
                );
            });
        };

        return $query;
    }
}
