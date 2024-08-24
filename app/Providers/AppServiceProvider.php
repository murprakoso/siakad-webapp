<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting; // Pastikan model Setting diimport

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menggunakan View Composer untuk menyebarkan data settings ke semua view
        View::composer('*', function ($view) {
            $settings = Setting::first(); // Ambil data pengaturan
            $view->with('settings', $settings); // Kirim data ke semua view
        });
    }
}
