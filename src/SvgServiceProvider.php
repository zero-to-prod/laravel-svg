<?php

namespace Zerotoprod\LaravelSvg;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * @link https://github.com/zero-to-prod/laravel-svg
 */
class SvgServiceProvider extends ServiceProvider
{
    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/svg.php', 'svg');
    }

    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/svg.php' => config_path('svg.php'),
        ], 'laravel-svg-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/laravel_svg'),
        ], 'laravel-svg-views');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', config('svg.view_namespace'));
        Blade::component(config('svg.component_prefix'), config('svg.view_component'));
    }
}
