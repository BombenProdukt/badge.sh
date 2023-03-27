<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/stars/{repo:wildcard}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $repo): array
    {
        return [
            'stars' => $this->client->graphql($repo, 'starCount')['starCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/gitlab/stars/fdroid/fdroidclient',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
