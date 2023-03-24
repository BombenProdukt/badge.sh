<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class QualityScoreBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->client->get($package)['detail'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('quality', $properties['quality']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/npms/quality-score/{package}',
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
            '/npms/quality-score/chalk' => 'quality score',
        ];
    }
}
