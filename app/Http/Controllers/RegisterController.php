<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRegisterRequest;
use App\Repositories\UserRegisterRepository;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $userRegisterRepository;
    public function __construct(UserRegisterRepository $userRegisterRepository)
    {
        $this->userRegisterRepository = $userRegisterRepository;
    }

    public function index()
    {
        return view('components.auth.register.user');
    }

    public function store(TenantRegisterRequest $request)
    {
        if ($this->userRegisterRepository->createTenant($request)) {
            return redirect()->route('login.user')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Register Success!'
            ]);
        }
    }
}
