<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Bank;
use App\Models\Rack;
use App\Models\User;
use App\Models\Admin;
use App\Models\Batch;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Subscription;
use App\Models\TempOutbound;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\TempTransaction;
use App\Models\WarehouseCategory;
use App\Repositories\UserRepository;
use App\Models\WarehouseSubscription;
use App\Repositories\AdminRepository;
use App\Repositories\TenantRepository;
use App\Repositories\InboundRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\WarehouseRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TempOutboundRepository;
use App\Repositories\TempTransactionRepository;
use App\Repositories\WarehouseCategoryRepository;
use App\Repositories\WarehouseSubscriptionCartRepository;

class AjaxController extends Controller
{
    private $adminRepository, $tenantRepository, $warehouseCategoryRepository, $warehouseRepository, $warehouseSubscriptionCartRepository, $tempTransactionRepository, $transactionRepository, $userRepository, $tempOutboundRepository, $productRepository, $supplierRepository, $inboundRepository;

    public function __construct(AdminRepository $adminRepository, TenantRepository $tenantRepository, WarehouseCategoryRepository $warehouseCategoryRepository, WarehouseRepository $warehouseRepository, WarehouseSubscriptionCartRepository $warehouseSubscriptionCartRepository, TempTransactionRepository $tempTransactionRepository, TransactionRepository $transactionRepository, UserRepository $userRepository, TempOutboundRepository $tempOutboundRepository, ProductRepository $productRepository, SupplierRepository $supplierRepository, InboundRepository $inboundRepository) {
        $this->adminRepository = $adminRepository;
        $this->tenantRepository = $tenantRepository;
        $this->warehouseCategoryRepository = $warehouseCategoryRepository;
        $this->warehouseRepository = $warehouseRepository;
        $this->warehouseSubscriptionCartRepository = $warehouseSubscriptionCartRepository;
        $this->tempTransactionRepository = $tempTransactionRepository;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->tempOutboundRepository = $tempOutboundRepository;
        $this->productRepository = $productRepository;
        $this->supplierRepository = $supplierRepository;
        $this->inboundRepository = $inboundRepository;
    }

    public function admin_detail_show($admin, $type)
    {
        if ($type == 'account') {
            return view('components.data-ajax.pages.data-admin-detail.account', [
                'admin' => $this->adminRepository->getAdmin($admin)
            ]);
        } elseif ($type == 'security') {
            return view('components.data-ajax.pages.data-admin-detail.security', [
                'admin' => $this->adminRepository->getAdmin($admin)
            ]);
        }
    }

    public function tenant_detail_show($tenant, $type)
    {
        if ($type == 'account') {
            return view('components.data-ajax.pages.data-tenant-detail.account', [
                'tenant' => $this->tenantRepository->getTenant($tenant)
            ]);
        } elseif ($type == 'security') {
            return view('components.data-ajax.pages.data-tenant-detail.security', [
                'tenant' => $this->tenantRepository->getTenant($tenant)
            ]);
        }
    }

    public function warehouse_detail_show($warehouse, $type)
    {
        if ($type == 'rental-activity') {
            return view('components.data-ajax.pages.data-warehouse-detail.rental-activity', [
                'warehouse' => $this->warehouseRepository->getWarehouse($warehouse)
            ]);
        }
    }

    public function admin_edit(User $user)
    {
        $admin = $user->admin;
        return view('components.data-ajax.pages.modal.data-edit-admin-modal', compact('admin'));
    }

    public function tenant_edit(Tenant $tenant)
    {
        return view('components.data-ajax.pages.modal.data-edit-tenant-modal', compact('tenant'));
    }

    public function warehouse_category_edit(WarehouseCategory $warehouse_category)
    {
        return view('components.data-ajax.pages.modal.data-edit-warehouse-category-modal', compact('warehouse_category'));
    }

    public function tax_edit(Tax $tax)
    {
        return view('components.data-ajax.pages.modal.data-edit-tax-modal', compact('tax'));
    }

    public function subscription_edit(Subscription $subscription)
    {
        return view('components.data-ajax.pages.modal.data-edit-subscription-modal', compact('subscription'));
    }

    public function bank_account_edit(Bank $bank)
    {
        return view('components.data-ajax.pages.modal.data-edit-bank-account-modal', compact('bank'));
    }

    public function warehouse_show()
    {
        return view('components.data-ajax.pages.modal.data-warehouse-show-modal', [
            'warehouses' => $this->warehouseRepository->getAllWarehouses()
        ]);
    }

    public function warehouse_subscription_store_edit(WarehouseSubscription $warehouse_subscription)
    {
        return $this->warehouseSubscriptionCartRepository->storeWarehouseSubscriptionCart(['warehouse_id' => $warehouse_subscription->warehouse_id, 'subscription_id' => $warehouse_subscription->subscription_id, 'price_rate' => $warehouse_subscription->price_rate, 'total_price' => $warehouse_subscription->total_price]);
    }

    public function tenant_shopping_cart_count()
    {
        return $this->tempTransactionRepository->getTempTransactionByTenantId()->count();
    }

    public function tenant_new_payment_count()
    {
        return $this->transactionRepository->getTransactionByStatus('payment')->count() > 0 ? $this->transactionRepository->getTransactionByStatus('payment')->count() : '';
    }

    public function admin_new_purchase_count()
    {
        return $this->transactionRepository->getTransactionByStatus('success')->count() > 0 ? $this->transactionRepository->getTransactionByStatus('success')->count() : '';
    }

    public function tenant_shopping_cart_destroy(TempTransaction $temp_transaction)
    {
        if($this->tempTransactionRepository->destroyTempTransaction($temp_transaction->id)) {
            return true;
        }
    }

    public function tenant_shopping_cart_update_subscription(Request $request, TempTransaction $temp_transaction)
    {
        if($this->tempTransactionRepository->updateTempTransaction($request, $temp_transaction->id)) {
            return true;
        }
    }

    public function deactivate_account()
    {
        if($this->userRepository->deactivateUser(auth()->user()->id)) {
            return true;
        }
    }

    public function product_category_edit(ProductCategory $category)
    {
        return view('components.data-ajax.pages.modal.data-edit-product-category-modal', compact('category'));
    }

    public function rack_edit(Rack $rack)
    {
        return view('components.data-ajax.pages.modal.data-edit-rack-modal', compact('rack'));
    }

    public function supplier_edit(Supplier $supplier)
    {
        return view('components.data-ajax.pages.modal.data-edit-supplier-modal', compact('supplier'));
    }

    public function tax_show(Tax $tax)
    {
        return view('components.data-ajax.pages.modal.data-detail-tax-amount-modal', compact('tax'));
    }

    public function customer_outbound_create(Warehouse $warehouse)
    {
        return view('components.data-ajax.pages.modal.data-create-customer-outbound-modal', compact('warehouse'));
    }

    public function product_outbound_store(Warehouse $warehouse, Product $product)
    {
        return $this->tempOutboundRepository->createTempOutboundWithNewOneProduct($warehouse, $product);
    }

    public function products_outbound_store(Warehouse $warehouse, Request $request)
    {
        return $this->tempOutboundRepository->createTempOutboundWithNewProducts($warehouse, $request);
    }

    public function product_quantity_outbound_edit(Request $request, TempOutbound $temp_outbound)
    {
        return $this->tempOutboundRepository->updateQuantityProductTempOutbound($request, $temp_outbound);
    }

    public function product_outbound_destroy(TempOutbound $temp_outbound)
    {
        if($this->tempOutboundRepository->destroyTempOutboundById($temp_outbound->id)) {
            return true;
        }
    }

    public function temp_outbounds_destroy(Request $request)
    {
        if($this->tempOutboundRepository->destroyTempOutboundsById($request)) {
            return true;
        }
    }

    public function inbound_edit(Batch $inbound)
    {
        $products = $this->productRepository->getAllProductByWarehouseIdAndTenantId($inbound->warehouse->id);
        $suppliers = $this->supplierRepository->getAllSupplierByWarehouseIdAndTenantId($inbound->warehouse->id);

        return view('components.data-ajax.pages.modal.data-edit-inbound-modal', compact('inbound', 'products', 'suppliers'));
    }

    public function inbound_code_check(Request $request)
    {
        return $this->inboundRepository->checkInboundCode($request);
    }

    public function warehouse_product_performance_detail(Product $product)
    {
        return view('components.data-ajax.pages.modal.data-warehouse-product-performance-modal', compact('product'));
    }

    public function warehouse_supplier_performance_detail(Supplier $supplier)
    {
        return view('components.data-ajax.pages.modal.data-warehouse-supplier-performance-modal', compact('supplier'));
    }

    public function warehouse_customer_performance_detail(Customer $customer)
    {
        return view('components.data-ajax.pages.modal.data-warehouse-customer-performance-modal', compact('customer'));
    }

    public function tenant_product_performance_detail(Product $product)
    {
        return view('components.data-ajax.pages.modal.data-tenant-product-performance-modal', compact('product'));
    }

    public function tenant_supplier_performance_detail(Supplier $supplier)
    {
        return view('components.data-ajax.pages.modal.data-tenant-supplier-performance-modal', compact('supplier'));
    }

    public function tenant_customer_performance_detail(Customer $customer)
    {
        return view('components.data-ajax.pages.modal.data-tenant-customer-performance-modal', compact('customer'));
    }

    public function dashboard_revenue_weekly_growth()
    {
        return $this->transactionRepository->getWeeklyRevenueReport();
    }
}