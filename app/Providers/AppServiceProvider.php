<?php

namespace App\Providers;

use App\Filament\Resources\BrandResource;
use App\Filament\Resources\CollectionResource;
use App\Filament\Resources\ContactResource;
use App\Filament\Resources\NewsResource;
use App\Filament\Resources\OurTeamResource;
use App\Filament\Resources\PageResource;
use App\Filament\Resources\ProductTypeResource;
use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\SiteSettingResource;
use App\Filament\Resources\TaxResource;
use App\Filament\Resources\UserResource;
use App\Models\News;
use App\Models\SiteSetting;
use App\Modifiers\ShippingModifier;
use App\Observers\NewsObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Lunar\Admin\Filament\Resources\TaxClassResource;
use Lunar\Admin\Support\Facades\LunarPanel;
use Lunar\Base\ShippingModifiers;
use Lunar\Facades\ModelManifest;
use Lunar\Models\ProductType;
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
                    UserResource::class,
                    ServiceResource::class,
                    SiteSettingResource::class,
                    BrandResource::class,
                    PageResource::class,
                    ProductTypeResource::class,
                    OurTeamResource::class,
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

        ModelManifest::replace(
            \Lunar\Models\Contracts\Product::class,
            \App\Models\Product::class,
        );
        Paginator::useBootstrapFive();

        News::observe(NewsObserver::class);
        view()->composer('*', function ($view) {
            $siteSetting = SiteSetting::where('key', 'site')->first();
            $categories = ProductType::all();
            $view->with(['siteSetting'=>$siteSetting,'categories'=>$categories]);
        });

        ModelManifest::replace(
            \Lunar\Models\Contracts\Brand::class,
            \App\Models\Brand::class
        );
        ModelManifest::replace(
            \Lunar\Models\Contracts\ProductType::class,
            \App\Models\ProductType::class
        );
    }
}
