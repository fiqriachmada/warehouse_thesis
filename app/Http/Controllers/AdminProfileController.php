<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BillingRepository;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\BillingStoreRequest;
use App\Models\Bank;
use App\Repositories\AdminProfileRepository;
use App\Repositories\UserRepository;

class AdminProfileController extends Controller
{
    protected $adminProfileRepository, $billingRepository, $userRepository;

    public function __construct(AdminProfileRepository $adminProfileRepository, BillingRepository $billingRepository, UserRepository $userRepository)
    {
        $this->adminProfileRepository = $adminProfileRepository;
        $this->billingRepository = $billingRepository;
        $this->userRepository = $userRepository;
    }

    public function admin_profile_index()
    {
        return view('pages.admin.profile.index');
    }

    public function admin_teams_index()
    {
        return view('pages.admin.profile.index', [
            'teams' => $this->userRepository->getAllUserAdminExceptCore(),
        ]);
    }

    public function admin_setting_profile_index()
    {
        return view('pages.admin.settings.index');
    }

    public function admin_setting_profile_update(AdminUpdateRequest $request, $admin)
    {
        try {
            if ($request->validated()) {
                if ($this->adminProfileRepository->updateAdminIdentity($request, $admin)) {
                    return redirect()->back()->with([
                        'flash-type' => 'sweetalert',
                        'case' => 'default',
                        'position' => 'center',
                        'type' => 'success',
                        'message' => 'Update Success!'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function admin_setting_password_index()
    {
        return view('pages.admin.settings.index');
    }

    public function admin_setting_password_update(Request $request, $admin)
    {
        try {
            if ($this->adminProfileRepository->updateAdminPassword($request, $admin)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Change Password Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function admin_setting_billing_index()
    {
        return view('pages.admin.billing.index', [
            'bills' => $this->billingRepository->getAllBillingByUserId()
        ]);
    }

    public function admin_setting_billing_store(BillingStoreRequest $request)
    {
        try {
            if ($this->billingRepository->createBilling($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Add Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function admin_setting_billing_update(Request $request, Bank $bank)
    {
        try {
            if ($this->billingRepository->updateBilling($request, $bank->id)) {
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

    public function admin_setting_billing_destroy(Bank $bank)
    {
        try {
            if ($this->billingRepository->destroyBilling($bank->id)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Delete Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
