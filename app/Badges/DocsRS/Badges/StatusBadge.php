<?php

declare(strict_types=1);

namespace App\Badges\DocsRS\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $crate, ?string $version = 'latest'): array
    {
        $label = "docs@{$version}";

        if ($this->client->status($crate, $version)) {
            return $this->renderStatus($label, 'passing');
        }

        return $this->renderStatus($label, 'failing');
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
