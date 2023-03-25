<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SizeBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/winget/size/{appId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $appId): array
    {
        return $this->client->get($appId);
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
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
            '/winget/size/GitHub.cli' => 'size',
        ];
    }
}
