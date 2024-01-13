<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnquiryReply extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'enquiry_replies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'enquiry_id',
        'admin_id',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class, 'enquiry_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {
        if($request->has('enquiry')){
            $query->when($request['enquiry'] && filled($request['enquiry']), function ($q) use($request) {
                $q->whereHas(
                    'enquiry', function($q) use($request){
                        $q->where('message','like', '%'. $request['enquiry']. '%');
                    }
                );
            });
        };

        if ($request->has('message')){
            $query->when($request['message'] && filled($request['message']), function ($q) use($request) {
                $q->where('message', 'like', "%" . $request['message'] . "%");
            });
        };
          
        if ($request->has('admin')){
            $query->when($request['admin'] && filled($request['admin']), function ($q) use($request) {
                $q->where('admin', 'like', "%" . $request['admin'] . "%");
            });
        };
        
        return $query;
    }
}
