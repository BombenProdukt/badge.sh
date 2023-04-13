<?php

declare(strict_types=1);

namespace App\Badges\CTAN;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/ctan/license/{package}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        return $this->client->api($package);
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
                path: '/ctan/license/latexdiff',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
