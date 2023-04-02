<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\GetFileFromGitHub;
use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LernaBadge extends AbstractBadge
{
    protected string $route = '/github/lerna/{owner}/{repo}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

    public function handle(string $owner, string $repo): array
    {
        return GetFileFromGitHub::json($owner, $repo, 'lerna.json');
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'lerna');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'lerna',
                path: '/github/lerna/lerna/lerna',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
