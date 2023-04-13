<?php

declare(strict_types=1);

namespace App\Badges\Composer;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class KeywordsBadge extends AbstractBadge
{
    protected string $route = '/composer/keywords/{service:bitbucket,github,gitlab}/{user}/{repo}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $service, string $user, string $repo): array
    {
        $response = $this->client->get($service, $user, $repo);

        return [
            'name' => $response['name'],
            'keywords' => $response['keywords'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('keywords', \implode(', ', $properties['keywords']));
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'keywords',
                path: '/composer/keywords/github/laravel/laravel',
                data: $this->render(['keywords' => ['framework', 'laravel']]),
            ),
        ];
    }
}
