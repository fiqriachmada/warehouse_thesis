<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = "string";
    protected $fillable = [
        'id',
        'category'
    ];

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }
}
