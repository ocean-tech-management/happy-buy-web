<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalCodeLog extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'personal_code_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeGeneratePersonalCode($query, $length)
    {
        do {
            $key = $this->generate($length);
            $check = PersonalCodeLog::where('name', $key)->count();
        } while ($check >= 1);

        PersonalCodeLog::create(['name' => $key]);

        return $key;
    }

    function generate($length)
    {
        $pool = array_merge(range(2, 9), range('a', 'h'), range('j', 'k'), range('m', 'n'), range('p', 'z'), range(2, 9));

        $key = "";

        for ($i = 0; $i < $length; $i++) {
            $key .= $pool[mt_rand(0, count($pool) - 1)];
        }

        return strtoupper($key);
    }
}
