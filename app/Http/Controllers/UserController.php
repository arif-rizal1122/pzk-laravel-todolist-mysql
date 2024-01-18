<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
     private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return response()->view('users.login', [
            "title" =>"login"
        ]);
    }




    public function doLogin(Request $request): Response|RedirectResponse
    {
        /* ambil data */
        $user = $request->input("user");
        $password = $request->input("password");

        /* validate data jika kososng */
        if(empty($user) || empty($password))
        {
            return response()->view('users.login', [
                'title' => 'login',
                'error' => 'user or password is required'
            ]);
        }

        /* jika data inputan sama dengan user dan password */
        if($this->userService->login($user, $password))
        {
            /* buatkan  (put / buat session nya) */
            $request->session()->put("user" , $user);
            return redirect("/");
        } 


        /* jika gagal */
        return response()->view('users.login', [
            'title' => 'login',
            'error' => 'username or password wrong'
        ]);

    }






    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget("user");
        return redirect("/");
    }


}
