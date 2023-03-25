<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleaseOperatingSystemVersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/visual-studio-app-center/os-version/{owner}/{app}/{token}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $app, string $token): array
    {
        $response = $this->client->releases($owner, $app, $token);

        return [
            'app' => $response['app_os'],
            'min' => $response['min_os'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText($properties['app'], '>='.$properties['min']);
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
            '/visual-studio-app-center/os-version/jct/my-amazing-app/ac70cv...' => 'minimum os version',
        ];
    }
}
