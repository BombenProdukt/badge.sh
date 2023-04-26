<?php

declare(strict_types=1);

namespace App\Badges\WinGet;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class SizeBadge extends AbstractBadge
{
    protected string $route = '/winget/size/{appId}';

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $appId): array
    {
        return $this->client->get($appId);
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
                path: '/winget/size/GitHub.cli',
                data: $this->render(['size' => '1024']),
            ),
        ];
    }
}
