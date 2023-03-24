<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        preg_match('/<th>license<\/th>\s*<td>([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'license' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/opam/license/{name}',
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
            '/opam/license/cohttp' => 'license',
        ];
    }
}
