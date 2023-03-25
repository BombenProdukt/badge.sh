<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class MonthlyQuestionsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/stack-exchange/monthly-questions/{site}/{query}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/stack-exchange/monthly-questions/{package}' => 'monthly questions',
        ];
    }
}
