<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTransaction extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'warehouse_id',
        'warehouse_subscription_id',
        'tenant_id',
        'subtotal'
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function warehouse_subscription()
    {
        return $this->belongsTo(WarehouseSubscription::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
