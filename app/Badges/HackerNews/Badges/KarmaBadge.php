<?php

declare(strict_types=1);

namespace App\Badges\HackerNews\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/hackernews/karma/pg' => 'karma',
        ];
    }
}
