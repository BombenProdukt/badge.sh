<?php

declare(strict_types=1);

namespace App\Badges\HTTPS\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RequestBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/https/{host}/{path?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $host, ?string $path = null): array
    {
        return $this->client->get($host, $path);
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'],
            'message' => $properties['message'],
            'messageColor' => $properties['messageColor'],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/https/cal-badge-icd0onfvrxx6.runkit.sh' => 'https endpoint',
            '/https/cal-badge-icd0onfvrxx6.runkit.sh/Asia/Shanghai' => 'https endpoint (with path args)',
            '/https/cal-badge-icd0onfvrxx6.runkit.sh/America/Los_Angeles' => 'https endpoint (with path args)',
        ];
    }
}
