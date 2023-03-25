<?php

declare(strict_types=1);

namespace App\Badges\OSSLifecycle\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/oss-lifecycle/status/{user}/{repo}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $user, string $repo, ?string $branch = null): array
    {
        return [
            'status' => Regex::match('/osslifecycle=(.*)/', $this->client->get($user, $repo, $branch))->group(1),
        ];
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
            '/oss-lifecycle/status/Netflix/osstracker' => 'status',
            '/oss-lifecycle/status/Netflix/osstracker/documentation' => 'status with branch',
        ];
    }
}
