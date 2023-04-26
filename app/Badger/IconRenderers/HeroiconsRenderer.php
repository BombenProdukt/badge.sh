<?php

declare(strict_types=1);

namespace App\Badger\IconRenderers;

use App\Badger\Contracts\IconRenderer;
use BombenProdukt\BladeIcons\Facades\VectorFactory;

final class HeroiconsRenderer implements IconRenderer
{
    public function render(string $name): string
    {
        return VectorFactory::make(name: $name, attributes: ['stroke' => '#fff'])->toBase64();
    }

    public function matches(string $name): bool
    {
        return \str_starts_with($name, 'heroicon');
    }
}
