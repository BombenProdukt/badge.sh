<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/apm/license/{package}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $package): array
    {
        $response = $this->client->get($package);

        return $response['versions'][$response['releases']['latest']];
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
                path: '/apm/license/linter',
                data: $this->render(['license' => 'MIT']),
                deprecated: true,
            ),
        ];
    }
}
