<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Admin extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $keyType = "string";
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'email',
        'phone',
        'pob',
        'dob',
        'gender',
        'address',
        'status'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('admin_images')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
