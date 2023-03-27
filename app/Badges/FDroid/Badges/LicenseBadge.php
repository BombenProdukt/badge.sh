<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/f-droid/license/{appId}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $appId): array
    {
        return [
            'license' => $this->client->get($appId)['License'],
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
                path: '/f-droid/license/org.tasks',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
