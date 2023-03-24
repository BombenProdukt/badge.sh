<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class DocsBadge extends AbstractBadge
{
    public function handle(string $pod): array
    {
        return $this->renderPercentage($this->service(), Arr::get($this->client->get($pod), 'cocoadocs.doc_percent', 0));
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cocoapods/doc-percent/{pod}',
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
            '/cocoapods/doc-percent/AFNetworking' => 'documentation coverage (percentage)',
        ];
    }
}
