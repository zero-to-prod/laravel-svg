<?php

namespace Zerotoprod\LaravelSvg;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\View\Component;

/**
 * @link https://github.com/zero-to-prod/laravel-svg
 */
class Svg extends Component
{
    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public const name = 'name';
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
    public const alt = 'alt';
    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public const text = 'text';

    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
    public function __construct(
        public readonly string $name,
        public readonly ?string $classname = null,
        public readonly ?string $fill = null,
        public readonly ?string $alt = null,
    ) {
    }

    /**
     * @link https://github.com/zero-to-prod/laravel-svg
     */
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
