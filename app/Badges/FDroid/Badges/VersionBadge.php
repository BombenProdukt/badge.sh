<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/f-droid/{appId}/version';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $appId): array
    {
        return [
            'version' => $this->client->get($appId)['CurrentVersion'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/f-droid/org.schabi.newpipe/version',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/f-droid/com.amaze.filemanager/version',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
