<?php

namespace Zerotoprod\LaravelSvg;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Svg extends Component
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $classname = null,
        public readonly ?string $fill = null,
        public readonly ?string $alt = null,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view(
            view: config('svg.view'),
            data: [
                'name' => $this->name,
                'classname' => $this->classname,
                'fill' => $this->fill,
                'text' => $this->alt ?? $this->name,
            ]
        );
    }
}
