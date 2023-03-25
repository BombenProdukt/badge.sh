<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CarbonBadge extends AbstractBadge
{
    protected array $routes = [
        '/ecologi/carbon/{username}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $username): array
    {
        return [
            'count' => $this->client->carbon($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('carbon offset', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/ecologi/carbon/ecologi',
                data: $this->render([]),
            ),
        ];
    }
}
