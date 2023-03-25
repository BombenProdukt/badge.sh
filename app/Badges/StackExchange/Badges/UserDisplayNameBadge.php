<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Enums\Category;

final class UserDisplayNameBadge extends AbstractBadge
{
    protected array $routes = [
        '/stack-exchange/user/display-name/{site}/{query}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return [
            'name' => $this->client->user($site, $query)['display_name'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('display-name', $properties['name']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/stack-exchange/user/display-name/stackoverflow/123' => 'display-name',
        ];
    }
}
