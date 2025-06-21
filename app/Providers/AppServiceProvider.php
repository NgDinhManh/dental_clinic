<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\Menuadmin;
use App\Models\Menu_doctor;
use App\Models\Menu_receptionist;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

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
        View::composer('*', function ($view) {
            $menus = Menu::where('isactive', 1)->get();
            $view->with('menus', $menus);
        });

        View::composer('*', function ($view) {
            $menuadmins = Menuadmin::where('isactive', 1)->get();
            $view->with('menuadmins', $menuadmins);
        });

        View::composer('*', function ($view) {
            $menu_doctors = Menu_doctor::where('isactive', 1)->get();
            $view->with('menu_doctors', $menu_doctors);
        });

        View::composer('*', function ($view) {
            $menu_receptionists = Menu_receptionist::where('isactive', 1)->get();
            $view->with('menu_receptionists', $menu_receptionists);
        });

        View::composer('*', function($view) {
            if(Auth::user()) {
                $notifications = Notification::where('receiver_id', Auth::user()->userid)->where('is_deleted', 0)->orderBy('created_at', 'desc')->take(6)->get();
                $view->with('notifications', $notifications);
            }
        });

        Paginator::useBootstrapFive();
    }
}
