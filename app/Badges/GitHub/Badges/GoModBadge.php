<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\GetFileFromGitHub;
use App\Data\BadgePreviewData;
use App\Enums\Category;
use Spatie\Regex\Regex;

final class GoModBadge extends AbstractBadge
{
    protected string $route = '/github/gomod/{owner}/{repo}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

    public function handle(string $owner, string $repo): array
    {
        $response = GetFileFromGitHub::raw($owner, $repo, 'src/go.mod');

        return [
            'version' => Regex::match('/go (.+)/', $response)->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'go');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'lerna',
                path: '/github/gomod/golang/go',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
