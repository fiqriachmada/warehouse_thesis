<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'name',
        'month_duration'
    ];

    public function warehouse_subscription()
    {
        return $this->hasMany(WarehouseSubscription::class);
    }

    public function warehouse_subscription_cart()
    {
        return $this->hasMany(WarehouseSubscriptionCart::class);
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
