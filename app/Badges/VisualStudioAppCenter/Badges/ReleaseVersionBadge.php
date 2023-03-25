<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Enums\Category;

final class ReleaseVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/visual-studio-app-center/version/{owner}/{app}/{token}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $app, string $token): array
    {
        return [
            'version' => $this->client->releases($owner, $app, $token)['short_version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['version']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/visual-studio-app-center/version/jct/my-amazing-app/ac70cv...' => 'version',
        ];
    }
}
