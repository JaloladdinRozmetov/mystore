<?php

namespace App\Providers;

use App\Filament\Resources\ContactResource;
use App\Filament\Resources\NewsResource;
use App\Models\News;
use App\Models\SiteSetting;
use App\Modifiers\ShippingModifier;
use App\Observers\NewsObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Lunar\Admin\Support\Facades\LunarPanel;
use Lunar\Base\ShippingModifiers;
use Lunar\Shipping\ShippingPlugin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        LunarPanel::panel(
            fn ($panel) =>
            $panel
                ->resources([
                ContactResource::class,
                    NewsResource::class,

                    ])
                ->plugins([
                new ShippingPlugin,
                    ])
                ->path('admin')

        )
            ->register();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ShippingModifiers $shippingModifiers): void
    {
        $shippingModifiers->add(
            ShippingModifier::class
        );

        \Lunar\Facades\ModelManifest::replace(
            \Lunar\Models\Contracts\Product::class,
            \App\Models\Product::class,
            // \App\Models\CustomProduct::class,
        );
        Paginator::useBootstrapFive();

        News::observe(NewsObserver::class);
        view()->composer('*', function ($view) {
            $siteSetting = SiteSetting::where('key', 'site')->first();
            $view->with('siteSetting', $siteSetting);
        });
    }
}
