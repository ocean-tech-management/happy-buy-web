<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $table = 'audit_logs';

    protected $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];

    protected $casts = [
        'properties' => 'collection',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeSearch($query, $request)
    {        
        if ($request->has('user_id')){
            $query->when($request['user_id'] && filled($request['user_id']), function($q) use($request){
                $q->where('user_id', $request['user_id']);
            });
        }; 
        
        if ($request->has('host')){
            $query->when($request['host'] && filled($request['host']), function($q) use($request){
                $q->where('host', 'like', '%'. $request['host'] . '%');
            });
        }; 

        if ($request->has('start_date')){
            $query->when($request['start_date'] && filled($request['start_date']), function($q) use($request){
                $q->whereDate('created_at', '>=',  $request['start_date']);
            });
        };

        if ($request->has('end_date')){
            $query->when($request['end_date'] && filled($request['end_date']), function($q) use($request){
                $q->whereDate('created_at', '<=',  $request['end_date']);
            });
        };

        return $query;
    }
}
