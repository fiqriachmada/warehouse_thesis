<?php

namespace App\Repositories;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Tenant;
use App\Models\TenantSubscription;
use Illuminate\Support\Facades\DB;

class UserRegisterRepository
{
    protected $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function createTenant($data)
    {
        $user_id = Uuid::uuid4()->toString();
        $tenant_id = Uuid::uuid4()->toString();

        DB::transaction(function () use ($user_id, $tenant_id, $data) {
            User::create([
                'id' => $user_id,
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'level' => 'tenant'
            ]);
    
            Tenant::create([
                'id' => $tenant_id,
                'user_id' => $user_id,
                'name' => $data['first_name'].' '.$data['last_name'],
                'npwp' => $data['npwp'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                // 'pob' => $data['pob'],
                // 'dob' => $data['dob'],
                // 'gender' => $data['gender'],
                'address' => $data['address'],
                'status' => 'active',
                'rank' => 'starter'
            ]);
        });   

        return true;
    }
}