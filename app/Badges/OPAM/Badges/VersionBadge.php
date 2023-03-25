<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/opam/version/{name}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $name): array
    {
        \preg_match('/class="package-version">([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'version' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/opam/version/merlin' => 'version',
            '/opam/version/ocamlformat' => 'version',
        ];
    }
}
