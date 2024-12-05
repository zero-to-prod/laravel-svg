<?php
return [
    'endpoint' => '/svg/{name}',
    'route_name' => 'svg',
    'view' => 'laravel_svg.svg',
    'svg_path' => 'laravel_svg.svg',
    'view_namespace' => 'svg',
    'component_prefix' => 'svg',
    'max_age' => 60 * 60 * 24,
    'view_component' => \Zerotoprod\LaravelSvg\Svg::class,
    'controller' => \Zerotoprod\LaravelSvg\Http\Controllers\SvgController::class
];