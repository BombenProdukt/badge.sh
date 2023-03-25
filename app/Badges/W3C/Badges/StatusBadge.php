<?php

declare(strict_types=1);

namespace App\Badges\W3C\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/w3c/status',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(): array
    {
        return [
            'count' => collect($this->client->get($this->getRequestData('url'))['messages'])
                ->filter(fn ($message) => \in_array($message['type'], ['error', 'warning'], true))
                ->count(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('w3c', $properties['count'] > 0 ? 'failed' : 'passed');
    }

    public function routeRules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
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
            '/w3c/status?url=https://youtube.com/' => 'status',
        ];
    }
}
