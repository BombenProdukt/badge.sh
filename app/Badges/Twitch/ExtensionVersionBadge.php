<?php

declare(strict_types=1);

namespace App\Badges\Twitch;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ExtensionVersionBadge extends AbstractBadge
{
    protected string $route = '/twitch/extension-version/{appId}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $appId): array
    {
        return $this->client->extension($appId);
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
                path: '/twitch/extension-version/2nq5cu1nc9f4p75b791w8d3yo9d195',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
