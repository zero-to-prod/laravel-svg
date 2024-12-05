<?php

namespace Zerotoprod\LaravelSvg\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class SvgController
{
    public const classname = 'classname';

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

        $max_age = config('svg.max_age');

        $content = view(
            view: $view,
            data: [self::classname => $Request->query(self::classname)]
        )->render();

        $ETag = md5($content);

        if ($Request->header('If-None-Match') === $ETag) {
            return response(
                content: '',
                status: 304,
                headers: ['ETag' => $ETag]
            );
        }

        return response(
            content: $content,
            status: 200,
            headers: [
                'Content-Type' => 'image/svg+xml',
                'Cache-Control' => "max-age=$max_age, public",
                'Expires' => gmdate('D, d M Y H:i:s', time() + $max_age).' GMT',
                'ETag' => $ETag,
            ]
        );
    }
}