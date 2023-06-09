<?php

declare(strict_types=1);

namespace App\Badges\Conda;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/conda/license/{channel}/{package}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $channel, string $package): array
    {
        return $this->client->get($channel, $package);
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
                path: '/conda/license/conda-forge/python',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
