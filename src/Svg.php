<?php

namespace Zerotoprod\LaravelSvg;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\View\Component;

class Svg extends Component
{
    public const name = 'name';
    public const classname = 'classname';
    public const fill = 'fill';
    public const alt = 'alt';
    public const text = 'text';

    public function __construct(
        public readonly string $name,
        public readonly ?string $classname = null,
        public readonly ?string $fill = null,
        public readonly ?string $alt = null,
    ) {
    }

    public function render(): View|Application|Factory|Htmlable|Closure|string|\Illuminate\Contracts\Foundation\Application|null
    {
        return view(
            view: config('svg.view'),
            data: [
                self::name => $this->name,
                self::classname => $this->classname ?? null,
                self::fill => $this->fill ?? 'currentColor',
                self::text => $this->alt ?? $this->name,
            ]
        );
    }
}
