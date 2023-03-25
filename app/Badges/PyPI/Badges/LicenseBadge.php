<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/pypi/license/{project}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $project): array
    {
        return $this->client->get($project)['info'];
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
                path: '/pypi/license/pip',
                data: $this->render([]),
            ),
        ];
    }
}
