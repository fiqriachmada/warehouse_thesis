<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Tenant;
use App\Models\Warehouse;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\WarehouseCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Repositories\TaxRepository;
use App\Repositories\UserRepository;
use App\Repositories\AdminRepository;
use App\Http\Requests\TaxStoreRequest;
use App\Repositories\TenantRepository;
use App\Http\Requests\TaxUpdateRequest;
use App\Repositories\CountryRepository;
use App\Repositories\CategoryRepository;
use App\Http\Requests\AdminUpdateRequest;
use App\Repositories\WarehouseRepository;
use App\Http\Requests\TenantUpdateRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\WarehouseStoreRequest;
use App\Repositories\SubscriptionRepository;
use App\Http\Requests\WarehouseUpdateRequest;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;
use App\Repositories\WarehouseCategoryRepository;
use App\Http\Requests\WarehouseCategoryStoreRequest;
use App\Http\Requests\WarehouseCategoryUpdateRequest;
use App\Models\Tax;

class AdminMasterController extends Controller
{
    private $adminRepository, $userRepository, $tenantRepository, $warehouseCategoryRepository, $warehouseRepository, $subscriptionRepository, $countryRepository, $taxRepository;

    public function __construct(AdminRepository $adminRepository, UserRepository $userRepository, TenantRepository $tenantRepository, WarehouseCategoryRepository $warehoseCategoryRepository, WarehouseRepository $warehouseRepository, SubscriptionRepository $subscriptionRepository, CountryRepository $countryRepository, TaxRepository $taxRepository) {
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
        $this->tenantRepository = $tenantRepository;
        $this->warehouseCategoryRepository = $warehoseCategoryRepository;
        $this->warehouseRepository = $warehouseRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->countryRepository = $countryRepository;
        $this->taxRepository = $taxRepository;
    }

    public function master_admin_index()
    {
        return view('pages.admin.master.users.admin.index');
    }

    public function master_admin_store(AdminRequest $adminRequest)
    {
        
        if (auth()->user()->attribute == 'none') {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'You are not allowed!'
            ]);
        }

        if ($adminRequest->validated()) {
            DB::transaction(function () use ($adminRequest) {
                $this->userRepository->createUserAndAdmin($adminRequest);
            });

            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Admin has been created!'
            ]);
        }
    }

    public function master_admin_show(Admin $admin)
    {
        return view('pages.admin.master.users.admin.show', compact('admin'));
    }

    public function master_admin_destroy($admin)
    {
        if ($this->adminRepository->destroyAdmin($admin)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Admin has been deleted!'
            ]);
        }
    }

    public function master_admin_update_status(Admin $admin)
    {
        if ($this->adminRepository->changeStatus($admin->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Status has been changed!'
            ]);
        }
    }

    public function master_admin_update(AdminUpdateRequest $request, $admin)
    {
        if ($request->validated()) {
            if ($this->adminRepository->updateAdmin($request, $admin)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Admin has been updated!'
                ]);
            }
        }
    }

    public function master_admin_update_image(Request $request, $admin)
    {
        if ($this->adminRepository->updateAdminImage($request, $admin)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Image has been updated!'
            ]);
        }
    }

    public function master_admin_update_password(Request $request, Admin $admin)
    {
        if ($this->adminRepository->updateAdminPassword($request, $admin->user_id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Password has been updated!'
            ]);
        }
    }

    public function master_tenant_index()
    {
        return view('pages.admin.master.users.tenant.index');
    }

    public function master_tenant_update_status($tenant)
    {
        if ($this->tenantRepository->changeStatus($tenant)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Status has been changed!'
            ]);
        }
    }

    public function master_tenant_update(TenantUpdateRequest $request, $tenant)
    {
        if ($request->validated()) {
            if ($this->tenantRepository->updateTenant($request, $tenant)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Tenant has been updated!'
                ]);
            }
        }
    }

    public function master_tenant_show(Tenant $tenant)
    {
        return view('pages.admin.master.users.tenant.show', compact('tenant'));
    }

    public function master_tenant_update_image(Request $request, $tenant)
    {
        if ($this->tenantRepository->updateTenantImage($request, $tenant)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Image has been updated!'
            ]);
        }
    }

    public function master_tenant_update_password(Request $request, Tenant $tenant)
    {
        if ($this->tenantRepository->updateTenantPassword($request, $tenant->user_id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Password has been updated!'
            ]);
        }
    }

    public function master_tenant_destroy($tenant)
    {
        if ($this->tenantRepository->deleteTenant($tenant)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tenant has been deleted!'
            ]);
        }
    }

    public function master_storage_index()
    {
        return view('pages.admin.master.property.warehouse.index');
    }

    public function master_category_index()
    {
        return view('pages.admin.master.property.category.index');
    }

    public function master_category_store(WarehouseCategoryStoreRequest $request)
    {
        if ($request->validated()) {
            if ($this->warehouseCategoryRepository->createWarehouseCategory($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Category has been created!'
                ]);
            }
        }
    }

    public function master_category_show(WarehouseCategory $warehouse_category)
    {
        return view('pages.admin.master.property.category.show', compact('warehouse_category'));
    }

    public function master_category_update(WarehouseCategoryUpdateRequest $request, $warehouse_category)
    {
        if ($request->validated()) {
            if ($this->warehouseCategoryRepository->updateWarehouseCategory($request, $warehouse_category)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Category has been updated!'
                ]);
            }
        }
    }

    public function master_category_destroy($warehouse_category)
    {
        if ($this->warehouseCategoryRepository->deleteWarehouseCategory($warehouse_category)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Category has been deleted!'
            ]);
        }
    }

    public function master_warehouse_index()
    {
        return view('pages.admin.master.property.warehouse.index');
    }

    public function master_warehouse_create()
    {
        return view('pages.admin.master.property.warehouse.add', [
            'warehouse_categories' => $this->warehouseCategoryRepository->getAllWarehouseCategories(),
            'countries' => $this->countryRepository->getAllCountries()
        ]);
    }

    public function master_warehouse_store(WarehouseStoreRequest $request)
    {
        try {
            if ($request->validated()) {
                if ($this->warehouseRepository->createWarehouse($request)) {
                    return redirect()->back()->with([
                        'flash-type' => 'sweetalert',
                        'case' => 'default',
                        'position' => 'center',
                        'type' => 'success',
                        'message' => 'Warehouse has been created!'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_warehouse_edit(Warehouse $warehouse)
    {
        return view('pages.admin.master.property.warehouse.edit', [
            'warehouse' => $warehouse,
            'warehouse_categories' => $this->warehouseCategoryRepository->getAllWarehouseCategories(),
            'countries' => $this->countryRepository->getAllCountries()
        ]);
    }

    public function master_warehouse_update(WarehouseUpdateRequest $request, $warehouse)
    {
        if ($request->validated()) {
            if ($this->warehouseRepository->updateWarehouse($request, $warehouse)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Warehouse has been updated!'
                ]);
            }
        }
    }

    public function master_warehouse_show(Warehouse $warehouse)
    {
        return view('pages.admin.master.property.warehouse.show', compact('warehouse'));
    }

    public function master_warehouse_destroy($warehouse)
    {
        if ($this->warehouseRepository->deleteWarehouse($warehouse)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Warehouse has been deleted!'
            ]);
        }
    }

    public function master_subscription_index()
    {
        return view('pages.admin.master.subscription.index');
    }

    public function master_subscription_store(SubscriptionStoreRequest $request)
    {
        if ($request->validated()) {
            if ($this->subscriptionRepository->createSubscription($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Subscription has been created!'
                ]);
            }
        }
    }

    public function master_subscription_show(Subscription $subscription)
    {
        return view('pages.admin.master.subscription.show', compact('subscription'));
    }

    public function master_subscription_update(SubscriptionUpdateRequest $request, $subscription)
    {
        if ($this->subscriptionRepository->updateSubscription($request, $subscription)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Subscription has been updated!'
            ]);
        }
    }

    public function master_subscription_destroy($subscription)
    {
        if ($this->subscriptionRepository->deleteSubscription($subscription)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Subscription has been deleted!'
            ]);
        }
    }

    public function master_taxes_index()
    {
        return view('pages.admin.master.taxes.index');
    }

    public function master_taxes_store(TaxStoreRequest $request)
    {
        if ($request->validated()) {
            if ($this->taxRepository->createTax($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Tax has been created!'
                ]);
            }
        }
    }

    public function master_taxes_update(TaxUpdateRequest $request, $tax)
    {
        if ($this->taxRepository->updateTax($request, $tax)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tax has been updated!'
            ]);
        }
    }

    public function master_taxes_update_status(Tax $taxes)
    {
        if ($this->taxRepository->updateTaxStatus($taxes->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tax status has been updated!'
            ]);
        }
    }

    public function master_taxes_destroy(Tax $taxes)
    {
        if ($this->taxRepository->deleteTax($taxes->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Tax has been deleted!'
            ]);
        }
    }
}
