<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class ProductCategory extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Inactive',
    ];

    public $table = 'product_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_en',
        'name_zh',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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

        return $query;
    }
}
