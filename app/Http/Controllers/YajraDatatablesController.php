<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\User;
use App\Models\Admin;
use App\Models\Rented;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Transaction;
use App\Models\Subscription;
use App\Models\DetailTransaction;
use App\Repositories\TaxRepository;
use App\Repositories\RackRepository;
use App\Repositories\UserRepository;
use App\Repositories\TenantRepository;
use App\Repositories\BillingRepository;
use App\Repositories\InboundRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Request;
use App\Repositories\CustomerRepository;
use App\Repositories\OutboundRepository;
use App\Repositories\SupplierRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\WarehouseRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TempOutboundRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\DetailTransactionRepository;
use App\Repositories\WarehouseCategoryRepository;
use App\Repositories\WarehouseSubscriptionRepository;

class YajraDatatablesController extends Controller
{
    protected $userRepository, $tenantRepository, $warehouseCategoryRepository, $warehouseRepository, $subscriptionRepository, $warehouseSubscriptionRepository, $taxRepository, $transactionRepository, $billingRepository, $productRepository, $productCategoryRepository, $rackRepository, $supplierRepository, $customerRepository, $inboundRepository, $detailTransactionRepository, $outboundRepository, $tempOutboundRepository;

    public function __construct(UserRepository $userRepository, TenantRepository $tenantRepository, WarehouseCategoryRepository $warehouseCategoryRepository, WarehouseRepository $warehouseRepository, SubscriptionRepository $subscriptionRepository, WarehouseSubscriptionRepository $warehouseSubscriptionRepository, TaxRepository $taxRepository, TransactionRepository $transactionRepository, BillingRepository $billingRepository, ProductRepository $productRepository, ProductCategoryRepository $productCategoryRepository, RackRepository $rackRepository, SupplierRepository $supplierRepository, CustomerRepository $customerRepository, InboundRepository $inboundRepository, DetailTransactionRepository $detailTransactionRepository, OutboundRepository $outboundRepository, TempOutboundRepository $tempOutboundRepository)
    {
        $this->userRepository = $userRepository;
        $this->tenantRepository = $tenantRepository;
        $this->warehouseCategoryRepository = $warehouseCategoryRepository;
        $this->warehouseRepository = $warehouseRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->warehouseSubscriptionRepository = $warehouseSubscriptionRepository;
        $this->taxRepository = $taxRepository;
        $this->transactionRepository = $transactionRepository;
        $this->billingRepository = $billingRepository;
        $this->productRepository = $productRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->rackRepository = $rackRepository;
        $this->supplierRepository = $supplierRepository;
        $this->customerRepository = $customerRepository;
        $this->inboundRepository = $inboundRepository;
        $this->detailTransactionRepository = $detailTransactionRepository;
        $this->outboundRepository = $outboundRepository;
        $this->tempOutboundRepository = $tempOutboundRepository;
    }

    public function admin_index()
    {
        $users = $this->userRepository->getUserExceptMeAndCore(auth()->user()->id);

        return DataTables::of($users)
        ->addColumn('index', function ($model) use ($users) {
            return $users->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.phone-column', compact('model'))->render();
        })
        ->addColumn('pob_dob', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.pob-dob-column', compact('model'))->render();
        })
        ->addColumn('gender', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.gender-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.address-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-admin.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'email', 'phone', 'pob_dob', 'gender', 'address', 'created_at', 'status', 'action'])
        ->make(true);
    }

    public function tenant_index()
    {
        $tenants = $this->tenantRepository->getAllTenants();

        return DataTables::of($tenants)
        ->addColumn('index', function ($model) use ($tenants) {
            return $tenants->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.name-column', compact('model'))->render();
        })
        ->addColumn('npwp', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.identity-number-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.phone-column', compact('model'))->render();
        })
        ->addColumn('pob_dob', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.pob-dob-column', compact('model'))->render();
        })
        ->addColumn('gender', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.gender-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.address-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tenant.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'npwp', 'email', 'phone', 'pob_dob', 'gender', 'address', 'created_at', 'status', 'action'])
        ->make(true);
    }

    public function warehouse_index($type)
    {
        $warehouses = $this->warehouseRepository->getAllWarehouses();

        return DataTables::of($warehouses)
        ->addColumn('index', function ($model) use ($warehouses) {
            return $warehouses->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.name-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.category-column', compact('model'))->render();
        })
        ->addColumn('capacity', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.capacity-column', compact('model'))->render();
        })
        ->addColumn('surface_area', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.surface-area-column', compact('model'))->render();
        })
        ->addColumn('building_area', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.building-area-column', compact('model'))->render();
        })
        ->addColumn('country', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.country-column', compact('model'))->render();
        })
        ->addColumn('zip_code', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.zip-code-column', compact('model'))->render();
        })
        ->addColumn('city', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.city-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.address-column', compact('model'))->render();
        })
        ->addColumn('storage_shelves', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.storage-shelves-column', compact('model'))->render();
        })
        ->addColumn('goods_handling_equipment', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.goods-handling-equipment-column', compact('model'))->render();
        })
        ->addColumn('effective_lighting_system', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.effective-lighting-system-column', compact('model'))->render();
        })
        ->addColumn('advanced_security_system', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.advanced-security-system-column', compact('model'))->render();
        })
        ->addColumn('toilet_and_rest_area', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.toilet-and-rest-area-column', compact('model'))->render();
        })
        ->addColumn('electricity', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.electricity-column', compact('model'))->render();
        })
        ->addColumn('administrative_room_or_office', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.administrative-room-or-office-column', compact('model'))->render();
        })
        ->addColumn('worker_safety_equipment', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.worker-safety-equipment-column', compact('model'))->render();
        })
        ->addColumn('firefighting_tools', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.firefighting-tools-column', compact('model'))->render();
        })
        ->addColumn('description', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.description-column', compact('model'))->render();
        })
        ->addColumn('admin', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.admin-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.status-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.created-at-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) use ($type) {
            return view('components.data-ajax.yajra-column.data-master-warehouse.action-column', [
                'model' => $model,
                'type' => $type
            ])->render();
        })
        ->rawColumns(['name', 'category', 'capacity', 'surface_area', 'building_area', 'country', 'zip_code', 'city', 'address', 'storage_shelves', 'effective_lighting_system', 'goods_handling_equipment', 'advanced_security_system', 'toilet_and_rest_area', 'electricity', 'administrative_room_or_office', 'worker_safety_equipment', 'firefighting_tools', 'description', 'admin', 'status', 'created_at', 'action'])
        ->make(true);
    }

    public function category_index()
    {
        $categories = $this->warehouseCategoryRepository->getAllWarehouseCategories();

        return DataTables::of($categories)
        ->addColumn('index', function ($model) use ($categories) {
            return $categories->search($model) + 1;
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-category.category-column', compact('model'))->render();
        })
        ->addColumn('total_warehouse', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-category.total-warehouse-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-category.action-column', compact('model'))->render();
        })
        ->rawColumns(['category', 'total_warehouses', 'action'])
        ->make(true);
    }

    public function subscription_index()
    {
        $subscriptions = $this->subscriptionRepository->getAllSubscriptions();

        return DataTables::of($subscriptions)
        ->addColumn('index', function ($model) use ($subscriptions) {
            return $subscriptions->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-subscription.name-column', compact('model'))->render();
        })
        ->addColumn('month_duration', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-subscription.month-duration-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-subscription.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'month_duration', 'action'])
        ->make(true);
    }

    public function taxes_index()
    {
        $taxes = $this->taxRepository->getAllTaxes();

        return DataTables::of($taxes)
        ->addColumn('index', function ($model) use ($taxes) {
            return $taxes->search($model) + 1;
        })
        ->addColumn('value', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tax.value-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tax.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-tax.action-column', compact('model'))->render();
        })
        ->rawColumns(['value', 'status', 'action'])
        ->make(true);
    }

    public function rental_price_calculation_index()
    {
        $warehouseSubscription = $this->warehouseSubscriptionRepository->getAllWarehouseSubscriptions();
        $warehouseSubscription = $warehouseSubscription->get();

        return DataTables::of($warehouseSubscription)
        ->addColumn('index', function ($model) use ($warehouseSubscription) {
            return $warehouseSubscription->search($model) + 1;
        })
        ->addColumn('warehouse_name', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.warehouse-name-column', compact('model'))->render();
        })
        ->addColumn('subscription_name', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.subscription-name-column', compact('model'))->render();
        })
        ->addColumn('month_duration', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.month-duration-column', compact('model'))->render();
        })
        ->addColumn('price_rate', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.price-rate-column', compact('model'))->render();
        })
        ->addColumn('total_price', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.total-price-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.action-column', compact('model'))->render();
        })
        ->rawColumns(['warehouse_name', 'subscription_name', 'month_duration', 'price_rate', 'total_price', 'action'])
        ->make(true);
    }

    public function warehouse_subscription_index($warehouse)
    {
        $warehouseSubscription = $this->warehouseSubscriptionRepository->getWarehouseSubscriptionByWarehouseId($warehouse);

        return DataTables::of($warehouseSubscription)
        ->addColumn('index', function ($model) use ($warehouseSubscription) {
            return $warehouseSubscription->search($model) + 1;
        })
        ->addColumn('warehouse_name', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.warehouse-name-column', compact('model'))->render();
        })
        ->addColumn('subscription_name', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.subscription-name-column', compact('model'))->render();
        })
        ->addColumn('month_duration', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.month-duration-column', compact('model'))->render();
        })
        ->addColumn('price_rate', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.price-rate-column', compact('model'))->render();
        })
        ->addColumn('total_price', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.total-price-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-price-calculation.action-column', compact('model'))->render();
        })
        ->rawColumns(['warehouse_name', 'subscription_name', 'month_duration', 'price_rate', 'total_price', 'action'])
        ->make(true);
    }

    public function transaction_payment()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('payment');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('payment_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-payment.payment-id-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-payment.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-payment.amount-column', compact('model'))->render();
        })
        ->addColumn('total_payment', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-payment.total-payment-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-payment.action-column', compact('model'))->render();
        })
        ->rawColumns(['payment_id', 'date', 'amount', 'total_payment', 'action'])
        ->make(true);
    }

    public function transaction_pending()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('success');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('payment_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-pending.payment-id-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-pending.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-pending.amount-column', compact('model'))->render();
        })
        ->addColumn('total_payment', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-pending.total-payment-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-pending.action-column', compact('model'))->render();
        })
        ->rawColumns(['payment_id', 'date', 'amount', 'total_payment', 'action'])
        ->make(true);
    }

    public function transaction_confirmed()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('confirmed');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('payment_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-confirmed.payment-id-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-confirmed.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-confirmed.amount-column', compact('model'))->render();
        })
        ->addColumn('total_payment', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-confirmed.total-payment-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-confirmed.action-column', compact('model'))->render();
        })
        ->rawColumns(['payment_id', 'date', 'amount', 'total_payment', 'action'])
        ->make(true);
    }

    public function transaction_declined()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('declined');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('payment_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-declined.payment-id-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-declined.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-declined.amount-column', compact('model'))->render();
        })
        ->addColumn('total_payment', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-declined.total-payment-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-transaction-declined.action-column', compact('model'))->render();
        })
        ->rawColumns(['payment_id', 'date', 'amount', 'total_payment', 'action'])
        ->make(true);
    }

    public function purchases_pending()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('payment');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('payment_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-pending.payment-id-column', compact('model'))->render();
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-pending.name-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-pending.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-pending.amount-column', compact('model'))->render();
        })
        ->addColumn('total_payment', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-pending.total-payment-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-pending.action-column', compact('model'))->render();
        })
        ->rawColumns(['payment_id', 'name', 'date', 'amount', 'total_payment', 'action'])
        ->make(true);
    }

    public function purchases_confirmed()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('confirmed');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('payment_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-confirmed.payment-id-column', compact('model'))->render();
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-confirmed.name-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-confirmed.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-confirmed.amount-column', compact('model'))->render();
        })
        ->addColumn('total_payment', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-confirmed.total-payment-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-confirmed.action-column', compact('model'))->render();
        })
        ->rawColumns(['payment_id', 'name', 'date', 'amount', 'total_payment', 'action'])
        ->make(true);
    }

    public function purchases_declined()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('declined');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('payment_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-declined.payment-id-column', compact('model'))->render();
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-declined.name-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-declined.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-declined.amount-column', compact('model'))->render();
        })
        ->addColumn('total_payment', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-declined.total-payment-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-purchase-declined.action-column', compact('model'))->render();
        })
        ->rawColumns(['payment_id', 'name', 'date', 'amount', 'total_payment', 'action'])
        ->make(true);
    }

    public function admin_daily_sales_report()
    {
        $transactions = $this->transactionRepository->getAllTransactionsGroupByPeriodically('day');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-daily-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-daily-sales-report.amount-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-daily-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-daily-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount', 'grand_total', 'action'])
        ->make(true);
    }

    public function admin_monthly_sales_report()
    {
        $transactions = $this->transactionRepository->getAllTransactionsGroupByPeriodically('month');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-monthly-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-monthly-sales-report.amount-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-monthly-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-monthly-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount', 'grand_total', 'action'])
        ->make(true);
    }

    public function admin_yearly_sales_report()
    {
        $transactions = $this->transactionRepository->getAllTransactionsGroupByPeriodically('year');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-yearly-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-yearly-sales-report.amount-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-yearly-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-yearly-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount', 'grand_total', 'action'])
        ->make(true);
    }

    public function bills_history()
    {
        $transactions = $this->transactionRepository->getTransactionByStatus('confirmed');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-bills-history.name-column', compact('model'))->render();
        })
        ->addColumn('bank', function ($model) {
            return view('components.data-ajax.yajra-column.data-bills-history.bank-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-bills-history.created-at-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-bills-history.grand-total-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'bank', 'created_at', 'grand_total'])
        ->make(true);
    }

    public function warehouse_product(Warehouse $warehouse)
    {
        $products = $this->productRepository->getAllProductByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.name-column', compact('model'))->render();
        })
        ->addColumn('stock', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.stock-column', compact('model'))->render();
        })
        ->addColumn('sale_price', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.sale-price-column', compact('model'))->render();
        })
        ->addColumn('weight', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.weight-column', compact('model'))->render();
        })
        ->addColumn('dimension', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.dimension-column', compact('model'))->render();
        })
        ->addColumn('expired_date', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.expired-date-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.status-column', compact('model'))->render();
        })
        ->addColumn('availability_status', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.availability-status-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.created-at-column', compact('model'))->render();
        })
        ->addColumn('updated_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.updated-at-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'stock', 'sale_price', 'weight', 'dimension', 'expired_date', 'status', 'availability_status', 'created_at', 'update_at', 'action'])
        ->make(true);
    }

    public function warehouse_product_category(Warehouse $warehouse)
    {
        $product_categories = $this->productCategoryRepository->getAllProductCategoryByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($product_categories)
        ->addColumn('index', function ($model) use ($product_categories) {
            return $product_categories->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-category.name-column', compact('model'))->render();
        })
        ->addColumn('total_product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-category.total-product-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-category.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'total_product', 'action'])
        ->make(true);
    }

    public function warehouse_rack(Warehouse $warehouse)
    {
        $racks = $this->rackRepository->getAllRackByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($racks)
        ->addColumn('index', function ($model) use ($racks) {
            return $racks->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-rack.name-column', compact('model'))->render();
        })
        ->addColumn('total_product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-rack.total-product-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-rack.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'total_product', 'action'])
        ->make(true);
    }

    public function warehouse_supplier(Warehouse $warehouse)
    {
        $suppliers = $this->supplierRepository->getAllSupplierByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($suppliers)
        ->addColumn('index', function ($model) use ($suppliers) {
            return $suppliers->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier.phone-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier.address-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'email', 'phone', 'address', 'status', 'action'])
        ->make(true);
    }
    
    public function warehouse_customer(Warehouse $warehouse)
    {
        $suppliers = $this->customerRepository->getAllCustomerByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($suppliers)
        ->addColumn('index', function ($model) use ($suppliers) {
            return $suppliers->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer.phone-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer.address-column', compact('model'))->render();
        })
        ->addColumn('type', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer.type-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer.created-at-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'email', 'phone', 'address', 'type', 'created_at', 'action'])
        ->make(true);
    }

    public function warehouse_inbound(Warehouse $warehouse)
    {
        $inbounds = $this->inboundRepository->getAllInboundByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($inbounds)
        ->addColumn('index', function ($model) use ($inbounds) {
            return $inbounds->search($model) + 1;
        })
        ->addColumn('code', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inbound.code-column', compact('model'))->render();
        })
        ->addColumn('supplier', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inbound.supplier-column', compact('model'))->render();
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inbound.product-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inbound.price-column', compact('model'))->render();
        })
        ->addColumn('on_hand', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inbound.on-hand-column', compact('model'))->render();
        })
        ->addColumn('received_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inbound.received-at-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inbound.action-column', compact('model'))->render();
        })
        ->rawColumns(['code', 'supplier', 'product', 'price', 'on_hand', 'received_at', 'action'])
        ->make(true);
    }

    public function warehouse_inventory(Warehouse $warehouse)
    {
        $inventories = $this->productRepository->getAllProductByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($inventories)
        ->addColumn('index', function ($model) use ($inventories) {
            return $inventories->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inventory.name-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inventory.category-column', compact('model'))->render();
        })
        ->addColumn('rack', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inventory.rack-column', compact('model'))->render();
        })
        ->addColumn('actual_stock', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inventory.actual-stock-column', compact('model'))->render();
        })
        ->addColumn('on_hand', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inventory.on-hand-column', compact('model'))->render();
        })
        ->addColumn('sale_price', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inventory.sale-price-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-inventory.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'product', 'category', 'rack', 'actual_stock', 'on_hand', 'sale_price', 'action'])
        ->make(true);
    }

    public function warehouse_supplier_performance(Warehouse $warehouse)
    {
        $suppliers = $this->supplierRepository->getAllSupplierWithJoinBatch($warehouse);

        return DataTables::of($suppliers)
        ->addColumn('index', function ($model) use ($suppliers) {
            return $suppliers->search($model) + 1;
        })
        ->addColumn('supplier', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier-performance-in-rental.supplier-column', compact('model'))->render();
        })
        ->addColumn('stock_sent', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier-performance-in-rental.stock-sent-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-supplier-performance-in-rental.action-column', compact('model'))->render();
        })
        ->rawColumns(['supplier', 'stock_sent', 'action'])
        ->make(true);
    }

    public function admin_detail_subscription(Subscription $subscription)
    {
        $renteds = array();

        foreach ($subscription->warehouse_subscription as $key => $subscription) {
            $renteds[] = $subscription->id;
        }

        $renteds = Rented::whereIn('warehouse_subscription_id', $renteds)->get();

        return DataTables::of($renteds)
        ->addColumn('index', function ($model) use ($renteds) {
            return $renteds->search($model) + 1;
        })
        ->addColumn('warehouse', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-detail-subscription.warehouse-column', compact('model'))->render();
        })
        ->addColumn('tenant', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-detail-subscription.tenant-column', compact('model'))->render();
        })
        ->addColumn('remaining_time', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-detail-subscription.remaining-time-column', compact('model'))->render();
        })
        ->addColumn('start_date', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-detail-subscription.start-date-column', compact('model'))->render();
        })
        ->addColumn('end_date', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-detail-subscription.end-date-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'warehouse', 'tenant', 'remaining_time', 'start_date', 'end_date'])
        ->make(true);
    }

    public function admin_taxes_report()
    {
        $taxes = $this->taxRepository->getAllTaxes();

        return DataTables::of($taxes)
        ->addColumn('index', function ($model) use ($taxes) {
            return $taxes->search($model) + 1;
        })
        ->addColumn('tax', function ($model) {
            return view('components.data-ajax.yajra-column.data-taxes-report.tax-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-taxes-report.amount-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-taxes-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['tax', 'amount', 'action'])
        ->make(true);
    }

    public function admin_detail_taxes_report(Tax $tax)
    {
        $taxes = $tax->transaction;

        return DataTables::of($taxes)
        ->addColumn('index', function ($model) use ($taxes) {
            return $taxes->search($model) + 1;
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-detail-taxes-report.date-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-detail-taxes-report.amount-column', compact('model'))->render();
        })
        ->rawColumns(['date', 'amount'])
        ->make(true);
    }

    public function admin_rental_activity_warehouse(Warehouse $warehouse)
    {
        $detail_transactions = $this->detailTransactionRepository->getDetailTransactionByWarehouseId($warehouse->id);

        foreach ($detail_transactions as $key => $detail_transaction) {
            $transaction_id[] = $detail_transaction->transaction_id;
        }

        $transactions = Transaction::whereIn('id', $transaction_id)->get();

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('tenant', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-activity.tenant-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-activity.date-column', compact('model'))->render();
        })
        ->addColumn('subscription', function ($model) use ($detail_transaction) {
            return view('components.data-ajax.yajra-column.data-rental-activity.subscription-column', compact('model', 'detail_transaction'))->render();
        })
        // ->addColumn('bank', function ($model) {
        //     return view('components.data-ajax.yajra-column.data-rental-activity.bank-column', compact('model'))->render();
        // })
        ->addColumn('total', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-activity.total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-rental-activity.action-column', compact('model'))->render();
        })
        ->rawColumns(['tenant', 'date', 'subscription', 'bank', 'total', 'action'])
        ->make(true);
    }

    public function warehouse_outbound(Warehouse $warehouse)
    {
        $outbounds = $this->outboundRepository->getAllOutboundByWarehouseIdAndTenantId($warehouse->id);

        return DataTables::of($outbounds)
        ->addColumn('index', function ($model) use ($outbounds) {
            return $outbounds->search($model) + 1;
        })
        ->addColumn('order_id', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-outbound.order-id-column', compact('model'))->render();
        })
        ->addColumn('customer', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-outbound.customer-column', compact('model'))->render();
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-outbound.date-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-outbound.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-outbound.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) use ($warehouse) {
            return view('components.data-ajax.yajra-column.data-warehouse-outbound.action-column', compact('model', 'warehouse'))->render();
        })
        ->rawColumns(['order_id', 'customer', 'date', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function warehouse_product_outbound(Warehouse $warehouse)
    {
        $products = $this->productRepository->getAllProductByWarehouseIdAndTenantIdWithActualStockNoZero($warehouse);

        return DataTables::of($products)
        ->addColumn('checkbox', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.checkbox-column', compact('model'))->render();
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.name-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.category-column', compact('model'))->render();
        })
        ->addColumn('rack', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.rack-column', compact('model'))->render();
        })
        ->addColumn('actual_stock', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.actual-stock-column', compact('model'))->render();
        })
        ->addColumn('sale_price', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.sale-price-column', compact('model'))->render();
        })
        ->addColumn('weight', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.weight-column', compact('model'))->render();
        })
        ->addColumn('dimension', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.dimension-column', compact('model'))->render();
        })
        ->addColumn('expired_date', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.expired-date-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) use ($warehouse) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-outbound.action-column', compact('model', 'warehouse'))->render();
        })
        ->rawColumns(['checkbox', 'name', 'category', 'rack', 'actual_stock', 'sale_price', 'weight', 'dimension', 'expired_date', 'action'])
        ->make(true);
    }

    public function warehouse_customer_outbound(Warehouse $warehouse)
    {
        $customers = $this->tempOutboundRepository->getCustomerTempOutbounds($warehouse);

        return DataTables::of($customers)
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-outbound.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-outbound.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-outbound.phone-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-outbound.address-column', compact('model'))->render();
        })
        ->addColumn('type', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-outbound.type-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) use ($warehouse) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-outbound.action-column', compact('model', 'warehouse'))->render();
        })
        ->rawColumns(['name', 'email', 'phone', 'address', 'type', 'action'])
        ->make(true);
    }

    public function tenant_sales_report_daily(Warehouse $warehouse)
    {
        $outbounds = $this->outboundRepository->getAllOutboundsGroupByPeriodically('day', $warehouse);

        return DataTables::of($outbounds)
        ->addColumn('index', function ($model) use ($outbounds) {
            return $outbounds->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-daily-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-daily-sales-report.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-daily-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-daily-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function tenant_sales_report_monthly(Warehouse $warehouse)
    {
        $outbounds = $this->outboundRepository->getAllOutboundsGroupByPeriodically('month', $warehouse);

        return DataTables::of($outbounds)
        ->addColumn('index', function ($model) use ($outbounds) {
            return $outbounds->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-monthly-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-monthly-sales-report.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-monthly-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-monthly-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function tenant_sales_report_yearly(Warehouse $warehouse)
    {
        $outbounds = $this->outboundRepository->getAllOutboundsGroupByPeriodically('year', $warehouse);

        return DataTables::of($outbounds)
        ->addColumn('index', function ($model) use ($outbounds) {
            return $outbounds->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-yearly-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-yearly-sales-report.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-yearly-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-yearly-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function tenant_product_performance(Warehouse $warehouse)
    {
        $products = $this->productRepository->getAllProductWithJoinDetailOutbound($warehouse);

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-product-performance-report.product-column', compact('model'))->render();
        })
        ->addColumn('stock_sold', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-product-performance-report.stock-sold-column', compact('model'))->render();
        })
        ->addColumn('income', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-product-performance-report.income-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-product-performance-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['product', 'stock_sold', 'income', 'action'])
        ->make(true);
    }

    public function warehouse_product_performance(Warehouse $warehouse)
    {
        $products = $this->productRepository->getAllProductWithJoinDetailOutbound($warehouse);

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-performance-in-rental.product-column', compact('model'))->render();
        })
        ->addColumn('stock_sold', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-performance-in-rental.stock-sold-column', compact('model'))->render();
        })
        ->addColumn('income', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-performance-in-rental.income-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-product-performance-in-rental.action-column', compact('model'))->render();
        })
        ->rawColumns(['product', 'stock_sold', 'income', 'action'])
        ->make(true);
    }

    public function tenant_supplier_performance(Warehouse $warehouse)
    {
        $suppliers = $this->supplierRepository->getAllSupplierWithJoinBatch($warehouse);

        return DataTables::of($suppliers)
        ->addColumn('index', function ($model) use ($suppliers) {
            return $suppliers->search($model) + 1;
        })
        ->addColumn('supplier', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-supplier-performance-report.supplier-column', compact('model'))->render();
        })
        ->addColumn('stock_sent', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-supplier-performance-report.stock-sent-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-supplier-performance-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['supplier', 'stock_sent', 'action'])
        ->make(true);
    }

    public function tenant_customer_performance(Warehouse $warehouse)
    {
        $customers = $this->customerRepository->getAllCustomerWithJoinOutbound($warehouse);

        return DataTables::of($customers)
        ->addColumn('index', function ($model) use ($customers) {
            return $customers->search($model) + 1;
        })
        ->addColumn('customer', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-customer-performance-report.customer-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-customer-performance-report.phone-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-customer-performance-report.email-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-customer-performance-report.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-customer-performance-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-customer-performance-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['customer', 'phone', 'email', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function warehouse_customer_performance(Warehouse $warehouse)
    {
        $customers = $this->customerRepository->getAllCustomerWithJoinOutbound($warehouse);

        return DataTables::of($customers)
        ->addColumn('index', function ($model) use ($customers) {
            return $customers->search($model) + 1;
        })
        ->addColumn('customer', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-performance-in-rental.customer-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-performance-in-rental.phone-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-performance-in-rental.email-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-performance-in-rental.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-performance-in-rental.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-customer-performance-in-rental.action-column', compact('model'))->render();
        })
        ->rawColumns(['customer', 'phone', 'email', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function tenant_rent_history(Warehouse $warehouse)
    {
        $rentals = $this->transactionRepository->getTransactionWithDetailTransaction($warehouse);

        return DataTables::of($rentals)
        ->addColumn('index', function ($model) use ($rentals) {
            return $rentals->search($model) + 1;
        })
        ->addColumn('subscription', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-rent-history.subscription-column', compact('model'))->render();
        })
        ->addColumn('started_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-rent-history.started-at-column', compact('model'))->render();
        })
        ->addColumn('ended_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-rent-history.ended-at-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-rent-history.price-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-tenant-rent-history.action-column', compact('model'))->render();
        })
        ->rawColumns(['subscription', 'started_at', 'ended_at', 'price', 'action'])
        ->make(true);
    }

    public function warehouse_sales_report_daily(Warehouse $warehouse)
    {
        $outbounds = $this->outboundRepository->getAllOutboundsGroupByPeriodically('day', $warehouse);

        return DataTables::of($outbounds)
        ->addColumn('index', function ($model) use ($outbounds) {
            return $outbounds->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-daily-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-daily-sales-report.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-daily-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-daily-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function warehouse_sales_report_monthly(Warehouse $warehouse)
    {
        $outbounds = $this->outboundRepository->getAllOutboundsGroupByPeriodically('month', $warehouse);

        return DataTables::of($outbounds)
        ->addColumn('index', function ($model) use ($outbounds) {
            return $outbounds->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-monthly-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-monthly-sales-report.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-monthly-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-monthly-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }

    public function warehouse_sales_report_yearly(Warehouse $warehouse)
    {
        $outbounds = $this->outboundRepository->getAllOutboundsGroupByPeriodically('year', $warehouse);

        return DataTables::of($outbounds)
        ->addColumn('index', function ($model) use ($outbounds) {
            return $outbounds->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-yearly-sales-report.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-yearly-sales-report.amount-total-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-yearly-sales-report.grand-total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-yearly-sales-report.action-column', compact('model'))->render();
        })
        ->rawColumns(['created_at', 'amount_total', 'grand_total', 'action'])
        ->make(true);
    }
    
    public function warehouse_detail_product_performance(Product $product)
    {
        $products = $product->detail_outbound;

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-product-performance.product-column', compact('model'))->render();
        })
        ->addColumn('date_sales', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-product-performance.date-sales-column', compact('model'))->render();
        })
        ->addColumn('quantity', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-product-performance.quantity-column', compact('model'))->render();
        })
        ->addColumn('subtotal', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-product-performance.subtotal-column', compact('model'))->render();
        })
        ->rawColumns(['product', 'date_sales', 'quantity', 'subtotal'])
        ->make(true);
    }

    public function warehouse_detail_supplier_performance(Supplier $supplier)
    {
        $suppliers = $supplier->batch;

        return DataTables::of($suppliers)
        ->addColumn('index', function ($model) use ($suppliers) {
            return $suppliers->search($model) + 1;
        })
        ->addColumn('supplier', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-supplier-performance.supplier-column', compact('model'))->render();
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-supplier-performance.product-column', compact('model'))->render();
        })
        ->addColumn('arrival_date', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-supplier-performance.arrival-date-column', compact('model'))->render();
        })
        ->addColumn('quantity', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-supplier-performance.quantity-column', compact('model'))->render();
        })
        ->rawColumns(['supplier', 'product', 'arrival_date', 'quantity'])
        ->make(true);
    }

    public function warehouse_detail_customer_performance(Customer $customer)
    {
        $customers = $customer->outbound;

        return DataTables::of($customers)
        ->addColumn('index', function ($model) use ($customers) {
            return $customers->search($model) + 1;
        })
        ->addColumn('customer', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-customer-performance.customer-column', compact('model'))->render();
        })
        ->addColumn('date_issue', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-customer-performance.date-issue-column', compact('model'))->render();
        })
        ->addColumn('total_product', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-customer-performance.total-product-column', compact('model'))->render();
        })
        ->addColumn('total_spend', function ($model) {
            return view('components.data-ajax.yajra-column.data-warehouse-detail-customer-performance.total-spend-column', compact('model'))->render();
        })
        ->rawColumns(['supplier', 'total_product', 'total_spend'])
        ->make(true);
    }
}