<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ElmVersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/elm-package/elm-version/{project}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

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
