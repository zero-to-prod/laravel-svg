<?php
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