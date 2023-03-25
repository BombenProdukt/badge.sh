<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ElmVersionBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        $parts = \preg_split('/\s+/', $this->client->get($project)['elm-version']);
        $parts = \array_filter($parts, fn ($it) => $it !== 'v');

        if (\count($parts) === 1) {
            return $parts[0];
        }

        [$lower, $lowerOp, $upperOp, $upper] = \array_values($parts);
        $lowerOp = \preg_replace('/^</', '>', $lowerOp);

        return [
            'version' => "{$lowerOp}{$lower} {$upperOp}{$upper}",
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT, Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/elm-package/elm-version/{project}',
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
            '/elm-package/elm-version/justinmimbs/date' => 'elm version',
        ];
    }
}
