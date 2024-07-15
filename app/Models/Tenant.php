<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tenant extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $keyType = "string";
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'npwp',
        'email',
        'phone',
        'address',
        'status',
        'rank'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('tenant_images')
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

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function temp_transaction()
    {
        return $this->hasMany(TempTransaction::class);
    }

    public function rented()
    {
        return $this->hasMany(Rented::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function product_category()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function rack()
    {
        return $this->hasMany(Rack::class);
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function batch()
    {
        return $this->hasMany(Batch::class);
    }

    public function outbound()
    {
        return $this->hasMany(Outbound::class);
    }

    public function detail_outbound()
    {
        return $this->hasMany(DetailOutbound::class);
    }

    public function temp_outbound()
    {
        return $this->hasMany(TempOutbound::class);
    }
}
