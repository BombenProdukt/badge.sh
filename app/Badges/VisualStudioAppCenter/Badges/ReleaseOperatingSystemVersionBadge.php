<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ReleaseOperatingSystemVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/visual-studio-app-center/os-version/{owner}/{app}/{token}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $app, string $token): array
    {
        $response = $this->client->releases($owner, $app, $token);

        return [
            'app' => $response['app_os'],
            'min' => $response['min_os'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText($properties['app'], '>='.$properties['min']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'minimum os version',
                path: '/visual-studio-app-center/os-version/jct/my-amazing-app/ac70cv...',
                data: $this->render([]),
            ),
        ];
    }
}
