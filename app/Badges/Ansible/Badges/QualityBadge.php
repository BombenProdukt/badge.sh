<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class QualityBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        return $this->renderNumber('quality', $this->client->content($projectId)['quality_score']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/ansible/quality/{projectId}',
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
            '/ansible/quality/432' => '',
        ];
    }
}
