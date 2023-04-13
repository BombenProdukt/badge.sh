<?php

declare(strict_types=1);

namespace App\Badges\Scoop;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/scoop/license/{app}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $app): array
    {
        return $this->client->main($app);
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
                path: '/scoop/license/caddy',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
