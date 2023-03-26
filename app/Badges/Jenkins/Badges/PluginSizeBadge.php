<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class PluginSizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/jenkins/plugin-size/{plugin}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $plugin): array
    {
        return Http::get('https://updates.jenkins-ci.org/current/update-center.actual.json')->throw()->json('plugins')[$plugin];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'plugin size',
                path: '/jenkins/plugin-size/blueocean',
                data: $this->render(['size' => '1024']),
            ),
        ];
    }
}
