<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Warehouse extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $keyType = "string";
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'admin_id',
        'warehouse_category_id',
        'name',
        'capacity',
        'surface_area',
        'building_area',
        'city',
        'zip_code',
        'country_id',
        'address',
        'description',
        'storage_shelves',
        'goods_handling_equipment',
        'effective_lighting_system',
        'advanced_security_system',
        'toilet_and_rest_area',
        'electricity',
        'administrative_room_or_office',
        'worker_safety_equipment',
        'firefighting_tools',
        'status'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('warehouse_images');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function warehouse_category()
    {
        return $this->belongsTo(WarehouseCategory::class);
    }

    public function warehouse_subscription()
    {
        return $this->hasMany(WarehouseSubscription::class);
    }

    public function warehouse_subscription_cart()
    {
        return $this->hasMany(WarehouseSubscriptionCart::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function temp_transaction()
    {
        return $this->hasMany(TempTransaction::class);
    }

    public function rented()
    {
        return $this->hasOne(Rented::class);
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
