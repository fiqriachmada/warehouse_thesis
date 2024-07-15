<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminProfileRepository
{
    protected $adminRepository, $userRepository;

    public function __construct(AdminRepository $adminRepository, UserRepository $userRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
    }

    public function updateAdminIdentity($data, $id)
    {
        $admin = $this->adminRepository->getAdmin($id);

        DB::transaction(function () use ($data, $id, $admin) {
            $admin->update([
                'name' => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'pob' => $data->pob,
                'dob' => $data->dob,
                'gender' => $data->gender,
                'address' => $data->address
            ]);
    
            if ($data->hasFile('admin_image')) {
                $admin->clearMediaCollection('admin_images');
    
                $media = $admin->addMediaFromRequest('admin_image')->withResponsiveImages()->toMediaCollection('admin_images');
    
                $media->update([
                    'model_id' => $admin->id,
                    'model_type' => Admin::class,
                ]);
            }
        });

        return true;
    }

    public function updateAdminPassword($data, $id)
    {
        
        $user_id = Admin::find($id)->user_id;
        return $this->adminRepository->updateAdminPassword($data, $user_id);
    }
}