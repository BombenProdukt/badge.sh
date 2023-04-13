<?php

declare(strict_types=1);

namespace App\Badges\Jenkins;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class PluginVersionBadge extends AbstractBadge
{
    protected string $route = '/jenkins/plugin-version/{plugin}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $plugin): array
    {
        return Http::get('https://updates.jenkins-ci.org/current/update-center.actual.json')->throw()->json('plugins')[$plugin];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'plugin version',
                path: '/jenkins/plugin-version/blueocean',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
