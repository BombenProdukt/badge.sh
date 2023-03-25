<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PassRatioBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/testspace/pass-ratio/{org}/{project}/{space}',
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
        $response = $this->client->get($org, $project, $space);

        return [
            'ratio' => ($response['passed'] / ($response['passed'] + $response['failed'] + $response['errored'])) * 100,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage($properties['ratio'] === 100 ? 'success' : 'critical', $properties['ratio']);
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
            '/testspace/pass-ratio/swellaby/swellaby:testspace-sample/main' => 'pass ratio',
        ];
    }
}
