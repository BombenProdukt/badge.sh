<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class TopLanguageBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        $languages = GitHub::repos()->languages($owner, $repo);

        return [
            'label' => array_key_first($languages),
            'value' => head($languages),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['label'], $properties['value']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/github/top-language/{owner}/{repo}',
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
            '/github/top-language/micromatch/micromatch' => 'top language',

        ];
    }
}
