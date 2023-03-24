<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class LanguagesBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        return $this->renderText('languages', implode(' | ', array_keys(GitHub::repos()->languages($owner, $repo))), 'blue.600');
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/github/languages/{owner}/{repo}',
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
            '/github/languages/micromatch/micromatch' => 'languages',

        ];
    }
}
