<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class DependencyBadge extends AbstractBadge
{
    protected array $routes = [
        '/hackage/dependencies/{package}',
    ];

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $package): array
    {
        $client = Http::baseUrl('https://packdeps.haskellers.com/')->throw();
        $client->get("licenses/{$package}");

        return [
            'outdated' => \str_contains($client->get("feed/{$package}")->body(), "Outdated dependencies for {$package}"),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('dependencies', $properties['outdated'] ? 'outdated' : 'up-to-date', $properties['outdated'] ? 'red.600' : 'green.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependencies',
                path: '/hackage/dependencies/Cabal',
                data: $this->render(['outdated' => false]),
            ),
        ];
    }
}
