<?php

namespace App\Http\Controllers;

use App\Models\WarehouseSubscription;
use Illuminate\Http\Request;
use App\Repositories\SubscriptionRepository;
use App\Repositories\WarehouseSubscriptionRepository;
use App\Repositories\WarehouseSubscriptionCartRepository;

class AdminCalculationController extends Controller
{
    protected $subscriptionRepository, $warehouseSubscriptionRepository, $warehouseSubscriptionCartRepository;

    public function __construct(WarehouseSubscriptionRepository $warehouseSubscriptionRepository, SubscriptionRepository $subscriptionRepository, WarehouseSubscriptionCartRepository $warehouseSubscriptionCartRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->warehouseSubscriptionRepository = $warehouseSubscriptionRepository;
        $this->warehouseSubscriptionCartRepository = $warehouseSubscriptionCartRepository;
    }

    public function admin_calculation_rental_price_index()
    {
        return view('pages.admin.calculation.rental-price.index');
    }

    public function admin_calculation_rental_price_create()
    {
        return view('pages.admin.calculation.rental-price.add', [
            'subscriptions' => $this->subscriptionRepository->getAllSubscriptionsWithoutStarterOrderByMonthDuration(),
            'warehouse_subscription_cart' => $this->warehouseSubscriptionCartRepository->getFirstWarehouseSubscriptionCart()
        ]);
    }

    public function admin_calculation_rental_price_store(Request $request, $id)
    {
        if ($this->warehouseSubscriptionCartRepository->createWarehouseSubscriptionCart($request, $id))
        {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Warehouse Selected!'
            ]);
        }
    }

    public function admin_calculation_rental_price_save()
    {
        if ($this->warehouseSubscriptionRepository->createWarehouseSubscription()) {
            return redirect('/calculation/rental-price')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Warehouse Subscription Created!'
            ]);
        } else {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Warehouse Subscription Creation is Exist!'
            ]);
        }
    }

    public function admin_calculation_rental_price_cancel()
    {
        if ($this->warehouseSubscriptionCartRepository->resetWarehouseSubscriptionCart()) {
            return redirect('/calculation/rental-price')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Warehouse Subscription Canceled!'
            ]);
        }
    }

    public function admin_calculation_rental_price_clear()
    {
        if ($this->warehouseSubscriptionCartRepository->resetWarehouseSubscriptionCart()) {
            return true;
        }
    }

    public function admin_calculation_rental_price_edit(WarehouseSubscription $warehouse_subscription)
    {
        return view('pages.admin.calculation.rental-price.add', [
            'subscriptions' => $this->subscriptionRepository->getAllSubscriptionsWithoutStarter(),
            'warehouse_subscription_cart' => $this->warehouseSubscriptionCartRepository->getFirstWarehouseSubscriptionCart(),
            'warehouse_subscription' => $warehouse_subscription
        ]);
    }

    public function admin_calculation_rental_price_update(WarehouseSubscription $warehouse_subscription)
    {
        if ($this->warehouseSubscriptionRepository->updateWarehouseSubscription($warehouse_subscription->id)) {
            return redirect('/calculation/rental-price')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Warehouse Subscription Updated!'
            ]);
        } else {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Subscription of Warehouse is Exist!'
            ]);
        }
    }
}
