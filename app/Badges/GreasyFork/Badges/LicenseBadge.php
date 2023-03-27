<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/greasyfork/license/{scriptId}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $scriptId): array
    {
        return $this->client->get($scriptId);
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
                path: '/greasyfork/license/407466',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
