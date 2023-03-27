<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class SizeBadge extends AbstractBadge
{
    protected string $route = '/cpan/size/{distribution}';

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $distribution): array
    {
        return $this->client->get("release/{$distribution}")['stat'];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'size',
                path: '/cpan/size/Moose',
                data: $this->render(['size' => '1024']),
            ),
        ];
    }
}
