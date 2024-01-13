<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Material extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        '1' => 'Show',
        '2' => 'Not Show',
    ];

    public $table = 'materials';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'file_1',
        'file_2',
        'file_3',
        'file_4',
        'file_5',
    ];

    protected $fillable = [
        'language_id',
        'file_title_1',
        'file_title_2',
        'file_title_3',
        'file_title_4',
        'file_title_5',
        'publish_year',
        'publish_month',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function getFile1Attribute()
    {
        return $this->getMedia('file_1')->last();
    }

    public function getFile2Attribute()
    {
        return $this->getMedia('file_2')->last();
    }

    public function getFile3Attribute()
    {
        return $this->getMedia('file_3')->last();
    }

    public function getFile4Attribute()
    {
        return $this->getMedia('file_4')->last();
    }

    public function getFile5Attribute()
    {
        return $this->getMedia('file_5')->last();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
