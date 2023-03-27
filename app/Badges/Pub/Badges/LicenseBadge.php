<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/pub/license/{package}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        $response = $this->client->web("packages/{$package}");

        \preg_match('/License<\/h3>\s*<p>([^(]+)\(/i', $response, $matches);

        return $this->renderLicense($matches[1]);
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
                path: '/pub/license/pubx',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
