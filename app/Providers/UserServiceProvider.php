<?php

namespace App\Providers;

use App\Services\Impl\UserServiceImpl;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;


/*
|  USER SERVICE INI MESTI DIDAFTARKAN DI FOLDER config.app (cari provider nya)
|
|
|
*/



class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /* Kode yang Anda berikan merupakan bagian dari konfigurasi pada Laravel, khususnya bagian yang mendefinisikan binding interface ke class yang mereka implementasikan. Dalam hal ini, UserService::class adalah interface dan UserServiceImpl::class adalah class yang implementasikan interface tersebut.

    Kode tersebut berarti bahwa setiap kali Anda meminta instance dari UserService::class melalui service container Laravel, Laravel akan memberikan instance dari UserServiceImpl::class. Ini adalah bagian dari fitur Dependency Injection yang disediakan oleh Laravel.

    Sebagai tambahan, property $singletons digunakan untuk mendefinisikan binding yang harus selalu menghasilkan instance yang sama saat diminta. Dengan demikian, setiap kali Anda meminta instance dari UserService::class, Anda akan mendapatkan instance yang sama dari UserServiceImpl::class 3. */

    public array $singletons = [
        UserService::class => UserServiceImpl::class
    ];

    /*
      implements DeferrableProvider ini memungkinkan jika kita tidak butuh userService Maka tidak akan perlu dibuatkan / atau lazy
    */

    public function provides()
    {
        /*  */
        return [UserService::class];
    }


    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
