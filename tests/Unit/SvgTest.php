<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Blade;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SvgTest extends TestCase
{
    /** @link SvgController */
    #[Test] public function returns_svg(): void
    {
        $files = glob(__DIR__.'/../../resources/views/svg/*.blade.php');

        $this->get(route(config('svg.route_name'), ['name' => basename($files[0], '.blade.php')]))
            ->assertOk()
            ->assertHeader('Content-Type', 'image/svg+xml')
            ->assertHeader('Cache-Control', 'max-age=86400, public');
    }

    /** @link SvgController */
    #[Test] public function not_found(): void
    {
        $this->get(route(config('svg.route_name'), ['name' => '_____bogus']))
            ->assertNotFound()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
    }

    /** @link SvgController */
    #[Test] public function renders_component(): void
    {
        self::assertEquals(
            expected: '<img class="h-4 w-4 opacity-70" src="http://localhost/svg/home" alt="home">',
            actual: Blade::render('<x-svg name="home" classname="h-4 w-4 opacity-70" />')
        );
    }

    /** @link SvgController */
    #[Test] public function overrides_alt(): void
    {
        self::assertEquals(
            expected: '<img class="h-4 w-4 opacity-70" src="http://localhost/svg/home" alt="alt">',
            actual: Blade::render('<x-svg name="home" classname="h-4 w-4 opacity-70" alt="alt" />')
        );
    }

    /** @link SvgController */
    #[Test] public function e_tag_matches(): void
    {
        $files = glob(__DIR__.'/../../resources/views/svg/*.blade.php');
        $name = basename($files[0], '.blade.php');

        $response = $this->get(route(config('svg.route_name'), ['name' => $name]));
        $etag = $response->headers->get('ETag');

        $this->get(route(config('svg.route_name'), ['name' => $name]), ['If-None-Match' => $etag])
            ->assertStatus(304)
            ->assertHeader('ETag', $etag);
    }

    /** @link SvgController */
    #[Test] public function no_etag_sent(): void
    {
        $files = glob(__DIR__.'/../../resources/views/svg/*.blade.php');
        $name = basename($files[0], '.blade.php');

        $response = $this->get(route(config('svg.route_name'), ['name' => $name]));
        $etag = $response->headers->get('ETag');

        $this->get(route(config('svg.route_name'), ['name' => $name]))
            ->assertOk()
            ->assertHeader('ETag', $etag);
    }

    /** @link SvgController */
    #[Test] public function svg_not_found_etag(): void
    {
        $this->get(route(config('svg.route_name'), ['name' => 'nonexistent']), ['If-None-Match' => 'random-etag'])
            ->assertNotFound()
            ->assertHeaderMissing('ETag');
    }

    /** @link SvgController */
    #[Test] public function invalid_name(): void
    {
        $this->get(route(config('svg.route_name'), ['name' => 'invalid/<name>']))
            ->assertNotFound()
            ->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    }
}