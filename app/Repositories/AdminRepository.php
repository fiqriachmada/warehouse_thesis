<?php

namespace App\Repositories;

use App\Models\Admin;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class AdminRepository
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllAdminExceptMe($id): Collection
    {
        return Admin::whereNot('user_id', $id)
                    ->orderBy('created_at', 'ASC')->get()
                    ->get();
    }

    public function getAdmin($id)
    {
        return Admin::find($id);
    }

    public function createAdmin($data)
    {
        return Admin::create([
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'pob' => $data['pob'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'address' => $data['address'],
        ]);
    }

    public function changeStatus($id)
    {
        $admin = self::getAdmin($id);

        if ($admin->status == 'active') {
            return $admin->update(['status' => 'inactive']);
        } else {
            return $admin->update(['status' => 'active']);
        }
    }

    public function updateAdmin($data, $id)
    {
        return self::getAdmin($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'pob' => $data['pob'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'address' => $data['address']
        ]);
    }

    public function updateAdminImage($data, $id)
    {
        $admin = self::getAdmin($id);

        if ($data->hasFile('admin_image')) {
            $media = $admin->addMediaFromRequest('admin_image')->withResponsiveImages()->toMediaCollection('admin_images');

            $media->where('model_type', Admin::class)
                ->where('model_id', $admin->id)
                ->update([
                    'model_id' => $admin->id,
                    'model_type' => Admin::class,
                ]);
        }

        return true;
    }

    public function updateAdminPassword($data, $user_id)
    {
        return $this->userRepository->updateUserPassword($data, $user_id);
    }

    public function destroyAdmin($admin)
    {
        $admin = self::getAdmin($admin);
        if ($admin->trashed()) {
            return $admin->forceDelete() && $admin->user->forceDelete();
        } else {
            return $admin->delete() && $admin->user->delete();
        }
    }
}