<?php

declare(strict_types=1);

namespace App\Badger;

use App\Badger\IconRenderers\HeroiconsRenderer;
use App\Badger\IconRenderers\IconifyRenderer;
use App\Badger\IconRenderers\SimpleIconsRenderer;
use RuntimeException;

final class IconFactory
{
    private static array $renderers = [
        HeroiconsRenderer::class,
        IconifyRenderer::class,
        SimpleIconsRenderer::class,
    ];

    public static function render(string $name): string
    {
        foreach (self::$renderers as $renderer) {
            $renderer = app()->make($renderer);

            if ($renderer->matches($name)) {
                return $renderer->render($name);
            }
        }

        throw new RuntimeException("Icon by name \"{$name}\" not found.");
    }
}
