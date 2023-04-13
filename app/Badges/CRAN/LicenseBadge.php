<?php

declare(strict_types=1);

namespace App\Badges\CRAN;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/cran/license/{package}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        return [
            'license' => \preg_replace('/\s*\S\s+file\s+LICEN[CS]E$/i', '', $this->client->db($package)['License']),
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
                path: '/cran/license/ggplot2',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
