<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use Ramsey\Uuid\Uuid;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Repositories\AdminRepository;
use App\Repositories\TenantRepository;

class UserRepository
{
    public function getUserExceptMeAndCore(string $id)
    {
        return User::where('level', 'admin')
                    ->whereNot('attribute', 'core')
                    ->whereNot('id', $id)
                    ->orderBy('created_at', 'ASC')
                    ->get();
    }

    public function getAllUserAdminExceptCore()
    {
        return User::where('level', 'admin')
                    ->whereNot('attribute', 'core')
                    ->orderBy('created_at', 'ASC')
                    ->get();
    }

    public function getAllUserTenant()
    {
        return User::where('level', 'tenant')->get();
    }

    public function getUser($id)
    {
        return User::find($id);
    }

    public function createUserAndAdmin($data)
    {
        $uuid = Uuid::uuid4()->toString();

        $user = User::create([
            'id' => $uuid,
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'level' => 'admin'
        ]);

        $admin = Admin::create([
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $uuid,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'pob' => $data['pob'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'address' => $data['address']
        ]);

        if ($data->hasFile('admin_image')) {
            $admin->addMediaFromRequest('admin_image')->withResponsiveImages()->toMediaCollection('admin_images');
        }

        return $user && $admin;
    }

    public function updateUserPassword($data, $id)
    {
        return self::getUser($id)->update([
            'password' => bcrypt($data['newPassword']),
        ]);
    }

    public function deactivateUser()
    {
        if (auth()->user()->level == 'admin') {
            return Admin::find(auth()->user()->admin->id)->update([
                'status' => 'inactive'
            ]);
        } elseif (auth()->user()->level == 'tenant') {
            return Tenant::find(auth()->user()->tenant->id)->update([
                'status' => 'inactive'
            ]);
        }
    }

    public function getTenantGrowthPercentage() {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        $currentMonthCount = self::getAllUserTenant()->where('created_at', $currentMonth)->where('created_at', $currentYear)->count();
        $lastMonthCount = self::getAllUserTenant()->where('created_at', $lastMonth)->where('created_at', $lastMonthYear)->count();

        if ($lastMonthCount == 0) {
            return $currentMonthCount > 0 ? 100 : 0;
        }

        $growth = (($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100;

        return round($growth, 2);
    }

    public function getTenantWithTransactionsCount() {
        return User::join('tenants', 'tenants.user_id', '=', 'users.id')
                    ->join('transactions', 'transactions.tenant_id', '=', 'tenants.id')
                    ->distinct('tenants.id')
                    ->count('tenants.id');
    }

    public function getTenantWithoutTransactionsCount() {
        return User::join('tenants', 'tenants.user_id', '=', 'users.id')
                    ->leftJoin('transactions', 'transactions.tenant_id', '=', 'tenants.id')
                    ->whereNull('transactions.id')
                    ->distinct('tenants.id')
                    ->count('tenants.id');
    }

    public function getTenantTransactionStatistics() {
        $totalTenants = $this->getAllUserTenant()->count();
        $tenantsWithTransactions = $this->getTenantWithTransactionsCount();
        $tenantsWithoutTransactions = $this->getTenantWithoutTransactionsCount();

        if ($totalTenants == 0) {
            return [
                'with_transactions' => 0,
                'without_transactions' => 0
            ];
        }

        $withTransactionsPercentage = ($tenantsWithTransactions / $totalTenants) * 100;
        $withoutTransactionsPercentage = ($tenantsWithoutTransactions / $totalTenants) * 100;

        return [
            'with_transactions' => round($withTransactionsPercentage, 2),
            'without_transactions' => round($withoutTransactionsPercentage, 2),
            'with_transactions_count' => $tenantsWithTransactions,
            'without_transactions_count' => $tenantsWithoutTransactions
        ];
    }
}