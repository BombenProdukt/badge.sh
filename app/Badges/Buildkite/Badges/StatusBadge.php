<?php

declare(strict_types=1);

namespace App\Badges\Buildkite\Badges;

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
        '/buildkite/status/{identifier}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $identifier, ?string $branch = null): array
    {
        return [
            'status' => $this->client->status($identifier, $branch),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function routeParameters(): array
    {
        return [];
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
            '/buildkite/status/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489' => 'build status',
            '/buildkite/status/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489/master' => 'build status',
        ];
    }
}
