<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCart;
use App\Models\Wishlist;
use Illuminate\Support\ServiceProvider;

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
            $cartCount = 0;
            $wishlistCount = 0;

            if (Auth::check()) {
                $cartCount = UserCart::where('user_id', Auth::id())
                            ->where('status', 'pending')
                            ->count();

                $wishlistCount = Wishlist::where('user_id', Auth::id())
                            ->count();
            }

            $view->with('cartCount', $cartCount)->with('wishlistCount', $wishlistCount);
        });
    }
}
