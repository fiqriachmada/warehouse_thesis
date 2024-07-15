<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\WarehouseSubscriptionCart;

use function PHPUnit\Framework\isEmpty;

class WarehouseSubscriptionCartRepository
{
    public function getFirstWarehouseSubscriptionCart()
    {
        return WarehouseSubscriptionCart::first();
    }

    public function getWarehouseSubscriptionCart($id)
    {
        return WarehouseSubscriptionCart::find($id);
    }

    public function getFirstWarehouseSubscriptionCartByWarehouseId($id)
    {
        return WarehouseSubscriptionCart::where('warehouse_id', $id)->first();
    }

    public function createWarehouseSubscriptionCart($data, $id)
    {
        if (self::getFirstWarehouseSubscriptionCartByWarehouseId($id)) {
            return self::getFirstWarehouseSubscriptionCartByWarehouseId($id)->update([
                'subscription_id' => $data['subscription_id'] ?? null,
                'price_rate' => $data['price_rate'] ?? null,
                'total_price' => intval(preg_replace("/[^0-9]/", "", $data['total_price'])) ?? null
            ]);
        } else {
            $warehouse_subscription_cart = self::getFirstWarehouseSubscriptionCart();

            if ($warehouse_subscription_cart) {
                if (isEmpty($warehouse_subscription_cart->subscription_id) || isEmpty($warehouse_subscription_cart->price_rate) || isEmpty($warehouse_subscription_cart->total_price)) {
                    return self::getFirstWarehouseSubscriptionCart()->update([
                        'warehouse_id' => $id,
                    ]);
                }
            }

            self::deleteWarehouseSubscriptionCartByWarehouseId($id);

            return WarehouseSubscriptionCart::create([
                'id' => Uuid::uuid4()->toString(),
                'warehouse_id' => $id
            ]);
        }
    }

    public function storeWarehouseSubscriptionCart(array $data)
    {
        if (self::getFirstWarehouseSubscriptionCart()) {
            self::resetWarehouseSubscriptionCart();
        }
        
        return WarehouseSubscriptionCart::create([
            'id' => Uuid::uuid4()->toString(),
            'warehouse_id' => $data['warehouse_id'],
            'subscription_id' => $data['subscription_id'],
            'price_rate' => $data['price_rate'],
            'total_price' => $data['total_price']
        ]);
    }

    public function deleteWarehouseSubscriptionCart($id)
    {
        if (self::getWarehouseSubscriptionCart($id)) {
            return self::getWarehouseSubscriptionCart($id)->delete();
        }
    }

    public function deleteWarehouseSubscriptionCartByWarehouseId($id)
    {
        if (self::getFirstWarehouseSubscriptionCartByWarehouseId($id)) {
            return self::getFirstWarehouseSubscriptionCartByWarehouseId($id)->delete();
        }
    }

    public function resetWarehouseSubscriptionCart()
    {
        if (self::getFirstWarehouseSubscriptionCart()) {
            return self::getFirstWarehouseSubscriptionCart()->delete();
        }
    }
}