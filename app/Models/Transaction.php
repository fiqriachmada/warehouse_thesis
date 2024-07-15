<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Transaction extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $incrementing = false;
    protected $keyType = "string";
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'tenant_id',
        'tax_id',
        'bank_id',
        'grand_total',
        'payment_due',
        'status',
        'snap_token'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('transaction_images')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function detail_transaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function rented()
    {
        return $this->hasMany(Rented::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
