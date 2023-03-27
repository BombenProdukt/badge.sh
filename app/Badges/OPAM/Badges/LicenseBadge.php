<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/opam/license/{name}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/opam/license/cohttp',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
