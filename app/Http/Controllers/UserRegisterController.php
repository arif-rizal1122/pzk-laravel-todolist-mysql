<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserControllerRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{

    protected UserService $userService;

    protected function __construct(UserService $userService)
    {
        return $this->userService = $userService;
    }



    
    public function register()
    {
        return response()->view('register.register', [
            "title" =>"login"
        ]);
    }


    public function doRegister(Request $request)
    {
         $user = $request->input('user');
         $email = $request->input('email');
         $password = $request->input('password');

         $this->userService->register($user, $email, $password);

         $user->save();

         return redirect()->view('/');

    }

}
