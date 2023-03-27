<?php

declare(strict_types=1);

namespace App\Badges\Cookbook\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/cookbook/version/{cookbook}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $cookbook): array
    {
        return [
            'version' => $this->client->version($cookbook),
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
                path: '/cookbook/version/chef-sugar',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
