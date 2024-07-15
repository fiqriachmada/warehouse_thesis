<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempOutbound extends Model
{
    use HasFactory;

    protected $keyType = "string";
    protected $fillable = [
        'id',
        'tenant_id',
        'warehouse_id',
        'subscription_id',
        'product_id',
        'customer_id',
        'quantity',
        'subtotal'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
