<?php

namespace App\Providers;

use App\Services\Impl\TodolistServiceImpl;
use App\Services\TodolistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
/* DeferrableProvider ini membuat data nya lazy hanya akan dipanggil ketika dibutuhkan */
{
   /* property $singletons digunakan untuk mendefinisikan binding yang harus selalu menghasilkan instance yang sama saat diminta. */ 
   public array $singletons = [
      TodolistService::class => TodolistServiceImpl::class
   ];


  /* 
  |  fitur dalam Laravel yang memungkinkan aplikasi untuk menunda      pembuatan dan pengisian service sampai saat dibutuhkan. Hal ini sangat berguna untuk mengoptimalkan waktu pemuatan awal aplikasi dan sumber  daya sistem.

  | Fungsi provides() dalam kelas service provider Anda digunakan untuk mendefinisikan sejumlah service yang ditawarkan oleh provider tersebut. Dalam hal ini, fungsi provides() mengembalikan array dengan satu elemen, yaitu TodolistService::class. Artinya, provider ini menawarkan layanan   dari kelas TodolistService. 
  |  
  */

    public function provides(): array
    {
        return [TodolistService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
