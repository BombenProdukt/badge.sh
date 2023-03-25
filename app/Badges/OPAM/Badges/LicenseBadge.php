<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/opam/license/{name}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $name): array
    {
        \preg_match('/<th>license<\/th>\s*<td>([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'license' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
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
