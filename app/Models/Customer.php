<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'tenant_id',
        'warehouse_id',
        'subscription_id',
        'name',
        'email',
        'phone',
        'address',
        'category',
        'type'
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

    public function outbound()
    {
        return $this->hasMany(Outbound::class);
    }

    public function temp_outbound()
    {
        return $this->hasMany(TempOutbound::class);
    }
}
