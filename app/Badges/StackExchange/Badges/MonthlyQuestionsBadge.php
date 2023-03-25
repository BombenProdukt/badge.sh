<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Enums\Category;

final class MonthlyQuestionsBadge extends AbstractBadge
{
    protected array $routes = [
        '/stack-exchange/monthly-questions/{site}/{query}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return [
            'query' => $query,
            'site' => $site,
            'count' => $this->client->questions($site, $query)['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['query'].'@'.$properties['site'], $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/stack-exchange/monthly-questions/{package}' => 'monthly questions',
        ];
    }
}
