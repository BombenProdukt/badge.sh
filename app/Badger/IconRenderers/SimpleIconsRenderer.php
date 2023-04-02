<?php

declare(strict_types=1);

namespace App\Badger\IconRenderers;

use App\Badger\Contracts\IconRenderer;
use PreemStudio\BladeIcons\Facades\VectorFactory;

final class SimpleIconsRenderer implements IconRenderer
{
    public function render(string $name): string
    {
        return VectorFactory::make(name: $name, attributes: ['stroke' => '#fff', 'fill' => '#fff'])->toBase64();
    }

    public function matches(string $name): bool
    {
        return \str_starts_with($name, 'simple-icons');
    }
}
