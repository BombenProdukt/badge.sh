<?php

declare(strict_types=1);

namespace App\Badges\Coverity\Badges;

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
        '/coverity/status/{projectId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectId): array
    {
        return [
            'status' => $this->client->status($projectId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus($this->service(), $properties['status']);
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
            '/coverity/status/3997' => 'status',
        ];
    }
}
