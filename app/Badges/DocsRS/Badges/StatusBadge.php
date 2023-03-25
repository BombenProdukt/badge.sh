<?php

declare(strict_types=1);

namespace App\Badges\DocsRS\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $crate, ?string $version = 'latest'): array
    {
        if ($this->client->status($crate, $version)) {
            return [
                'status' => 'passing',
                'version' => $version,
            ];
        }

        return [
            'status' => 'failing',
            'version' => $version,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('docs@'.$properties['version'], $properties['status']);
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/docsrs/version/{crate}/{version?}',
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
            '/docsrs/version/regex' => 'version',
        ];
    }
}
