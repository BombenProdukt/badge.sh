<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ErroredCountBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/testspace/errored-count/{org}/{project}/{space}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $org, string $project, string $space): array
    {
        return $this->client->get($org, $project, $space);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('errored', $properties['errored']);
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
            '/testspace/errored-count/swellaby/swellaby:testspace-sample/main' => 'errored tests count',
        ];
    }
}
