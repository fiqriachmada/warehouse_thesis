<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\TenantRepository;
use Illuminate\Support\Facades\DB;

class TenantProfileRepository
{
    protected $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function updateTenantIdentity($data, $id)
    {
        $tenant = $this->tenantRepository->getTenant($id);

        DB::transaction(function () use ($data, $id, $tenant) {
            $tenant->update([
                'name' => $data['name'],
                'npwp' => $data['npwp'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                // 'pob' => $data['pob'],
                // 'dob' => $data['dob'],
                'gender' => $data['gender'],
                'address' => $data['address']
            ]);

            if ($data->hasFile('tenant_image')) {
                $tenant->clearMediaCollection('tenant_images');

                $media = $tenant->addMediaFromRequest('tenant_image')->withResponsiveImages()->toMediaCollection('tenant_images');

                $media->update([
                    'model_id' => $tenant->id,
                    'model_type' => Tenant::class,
                ]);
            }
        });

        return true;
    }

    public function updateTenantPassword($data, $id)
    {
        return $this->tenantRepository->updateTenantPassword($data, $id);
    }
}