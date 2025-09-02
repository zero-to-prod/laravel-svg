<?php

namespace Zerotoprod\LaravelSvg;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

/**
 * @link https://github.com/zero-to-prod/laravel-svg
 */
class SvgController
{
    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public const classname = 'classname';
    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public const fill = 'fill';

    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public function __invoke(string $name, Request $Request): Application|Response|ResponseFactory
    {
        $view = config('svg.svg_path').'.'.$name;

        if (!View::exists($view)) {
            return response(
                content: 'SVG not found.',
                status: 404,
                headers: ['Content-Type' => 'text/plain']
            );
        }

        return response(
            content: view(
                view: $view,
                data: [
                    Svg::name => $name,
                    Svg::classname => '',
                    Svg::fill => $Request->query(self::fill),
                ]
            )->render(),
            status: 200,
            headers: ['Content-Type' => 'image/svg+xml']
        );
    }
}
