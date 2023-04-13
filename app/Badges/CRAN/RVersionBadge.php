<?php

declare(strict_types=1);

namespace App\Badges\CRAN;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RVersionBadge extends AbstractBadge
{
    protected string $route = '/cran/r-version/{package}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return [
            'version' => \preg_replace('/([<>=]+)\s+/', '$1', $this->client->db($package)['Depends']['R']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'R');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'r version',
                path: '/cran/r-version/data.table',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
