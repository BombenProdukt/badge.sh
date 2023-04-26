<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class DependabotStatusBadge extends AbstractBadge
{
    protected string $route = '/github/dependabot/{owner}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS, Category::DEPENDENCIES,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'successful' => Http::get("https://api.github.com/repos/{$owner}/{$repo}/contents/.github/dependabot.yml")->successful(),
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['successful']) {
            return [
                'label' => 'dependabot',
                'message' => 'Active',
                'messageColor' => 'green.600',
            ];
        }

        return [
            'label' => 'github',
            'message' => 'not found',
            'messageColor' => 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependabot status',
                path: '/github/dependabot/ubuntu/yaru',
                data: $this->render(['successful' => true]),
            ),
            new BadgePreviewData(
                name: 'dependabot status',
                path: '/github/dependabot/ubuntu/yaru',
                data: $this->render(['successful' => false]),
            ),
        ];
    }
}
