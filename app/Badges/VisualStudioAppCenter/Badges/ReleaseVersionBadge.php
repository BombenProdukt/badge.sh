<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/visual-studio-app-center/version/jct/my-amazing-app/ac70cv...',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
