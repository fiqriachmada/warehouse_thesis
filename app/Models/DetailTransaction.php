<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $keyType = "string";
    protected $fillable = [
        'id',
        'transaction_id',
        'warehouse_subscription_id',
        'subtotal',
        'started_at',
        'ended_at',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function warehouse_subscription()
    {
        return $this->belongsTo(WarehouseSubscription::class);
    }
}
