<?php

namespace Zerotoprod\LaravelSvg;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class SvgController
{
    public const classname = 'classname';
    public const fill = 'fill';

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
                    Svg::classname => null,
                    Svg::fill => $Request->query(self::fill),
                ]
            )->render(),
            status: 200,
            headers: ['Content-Type' => 'image/svg+xml']
        );
    }
}
