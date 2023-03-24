<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        preg_match('/class="package-version">([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'version' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/opam/version/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/opam/version/merlin'      => 'version',
            '/opam/version/ocamlformat' => 'version',
        ];
    }
}
