<?php

declare(strict_types=1);

namespace App\Badges\OSSLifecycle\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $user, string $repo, ?string $branch = null): array
    {
        return $this->renderStatus('status', Regex::match('/osslifecycle=(.*)/', $this->client->get($user, $repo, $branch))->group(1));
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/oss-lifecycle/status/{user}/{repo}/{branch?}',
        ];
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
            '/oss-lifecycle/status/Netflix/osstracker'               => 'status',
            '/oss-lifecycle/status/Netflix/osstracker/documentation' => 'status with branch',
        ];
    }
}
