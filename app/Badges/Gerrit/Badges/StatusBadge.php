<?php

declare(strict_types=1);

namespace App\Badges\Gerrit\Badges;

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
        '/gerrit/status/{changeId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $changeId): array
    {
        return $this->client->get($changeId);
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('status', $properties['status']);
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
            '/gerrit/status/1011478' => 'status',
        ];
    }
}
