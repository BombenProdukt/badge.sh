<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Enums\Category;

final class ReleaseSizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/visual-studio-app-center/size/{owner}/{app}/{token}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $app, string $token): array
    {
        return $this->client->releases($owner, $app, $token);
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function previews(): array
    {
        return [
            '/visual-studio-app-center/size/jct/my-amazing-app/ac70cv...' => 'size',
        ];
    }
}
