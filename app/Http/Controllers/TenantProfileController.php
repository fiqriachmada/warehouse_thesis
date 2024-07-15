<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Repositories\TenantRepository;
use App\Http\Requests\TenantUpdateRequest;
use App\Repositories\TenantProfileRepository;

class TenantProfileController extends Controller
{
    protected $tenantProfileRepository;

    public function __construct(TenantProfileRepository $tenantProfileRepository)
    {
        $this->tenantProfileRepository = $tenantProfileRepository;
    }

    public function tenant_profile_index()
    {
        return view('pages.tenant.profile.index');
    }

    public function tenant_setting_profile_index()
    {
        return view('pages.tenant.settings.index');
    }

    public function tenant_setting_profile_update(TenantUpdateRequest $request, Tenant $tenant)
    {
        try {
            if ($this->tenantProfileRepository->updateTenantIdentity($request, $tenant->id)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Update Success!'
                ]);
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function tenant_setting_password_index()
    {
        return view('pages.tenant.settings.index');
    }

    public function tenant_setting_password_update(Request $request, Tenant $tenant)
    {
        try {
            if ($this->tenantProfileRepository->updateTenantPassword($request, $tenant->user_id)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Password has been updated!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
