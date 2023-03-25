<?php

declare(strict_types=1);

namespace App\Badges\HackerNews\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class KarmaBadge extends AbstractBadge
{
    protected array $routes = [
        '/hackernews/karma/{username}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $username): array
    {
        return [
            'username' => $username,
            'karma' => $this->client->karma($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('u/'.$properties['username'].' karma', $properties['karma']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'karma',
                path: '/hackernews/karma/pg',
                data: $this->render([]),
            ),
        ];
    }
}
