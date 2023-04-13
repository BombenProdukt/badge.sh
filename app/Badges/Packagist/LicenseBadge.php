<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/packagist/license/{vendor}/{project}/{channel?}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $vendor, string $project, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $project);

        return [
            'license' => $packageMeta['versions'][$this->getVersion($packageMeta, $channel)]['license'][0],
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
                path: '/packagist/license/monolog/monolog',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
