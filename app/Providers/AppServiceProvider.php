<?php

namespace App\Providers;

use App\Models\MetaUrl;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);
        View::share('projectName', 'Zero Brokage');
        // // Get the current URL path
        // $currentUrl = $request->fullUrl(); // or use $request->url() for the full URL
        // $meta = MetaUrl::where('url', $currentUrl)->first();
        // // Share the $meta variable with all views
        // View::share('meta', $meta);

        try {
            // Get the current URL path
            $currentUrl = $request->fullUrl(); // or use $request->url() for the full URL
            $meta = MetaUrl::where('url', $currentUrl)->first();
        } catch (QueryException $e) {
            // Handle the exception for missing table or other query issues
            Log::error('Database query exception: ' . $e->getMessage());
            $meta = null; // Set meta to null if there's an issue
        }

        // Share the $meta variable with all views
        View::share('meta', $meta);
    }
}
