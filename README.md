# Zerotoprod\DataModel

![](./logo.png)

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/laravel-svg)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/laravel-svg/test.yml?label=tests)](https://github.com/zero-to-prod/laravel-svg/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/laravel-svg?color=blue)](https://packagist.org/packages/zero-to-prod/laravel-svg/stats)
[![php](https://img.shields.io/packagist/php-v/zero-to-prod/laravel-svg.svg?color=purple)](https://packagist.org/packages/zero-to-prod/laravel-svg/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/laravel-svg?color=f28d1a)](https://packagist.org/packages/zero-to-prod/laravel-svg)
[![License](https://img.shields.io/packagist/l/zero-to-prod/laravel-svg?color=pink)](https://github.com/zero-to-prod/laravel-svg/blob/main/LICENSE.md)

Serve your svg files from an endpoint.

## Installation

You can install the package via Composer:

```bash
composer require zero-to-prod/laravel-svg
```

## Publish Vendor Files
```bash
php artisan vendor:publish --tag=laravel-svg-config
php artisan vendor:publish --tag=laravel-svg-views
```

## Usage

```bladehtml
<x-svg name="home" classname="h-4 w-4 opacity-70" alt="alt" />
<!-- Renders -->
<img class="h-4 w-4 opacity-70" src="http://localhost/svg/home" alt="alt">
```

## Configuration

```php
return [
    'endpoint' => '/svg/{name}',
    'route_name' => 'svg',
    'view' => 'svg::svg',
    'view_namespace' => 'svg',
    'component_prefix' => 'svg',
    'max_age' => 2592000,
    'view_component' => \Zerotoprod\LaravelSvg\Svg::class,
    'controller' => \Zerotoprod\LaravelSvg\Http\Controllers\SvgController::class
];
```

## Testing

```shell
./vendor/bin/phpunit
```
