<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyMemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next): Response
    {
        /*
         if($request->session()->exists("user")) - Baris ini memeriksa apakah pengguna telah login atau belum dengan mengecek apakah data "user" ada di dalam sesi.
         */
        if($request->session()->exists("user"))
        {
        /* 
        return $next($request); - Jika pengguna sudah login (yaitu, data "user" ada di sesi), maka request akan diteruskan ke middleware berikutnya dalam rantai.
        */    
            return $next($request);
        } else {
        /*
        else { return redirect("/"); } - Jika pengguna belum login (yaitu, data "user" tidak ada di sesi), maka pengguna akan dialihkan ke halaman utama ("/").
        */    
            return redirect("/");
        }

    }
}
