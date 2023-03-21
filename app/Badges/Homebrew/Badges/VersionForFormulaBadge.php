<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Homebrew\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionForFormulaBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->get('formula', $package);

        if (isset($response['version'])) {
            $version = $response['version'];
        } else {
            $version = $response['versions']['stable'];
        }

        return $this->renderVersion($version);
    }

    public function service(): string
    {
        return 'Homebrew';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/homebrew/version/{package}',
            '/homebrew/version/{package}/formula',
            '/homebrew/version/{package}/cask',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('type', ['cask', 'formula']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/homebrew/version/fish' => 'version',
            '/homebrew/version/cake' => 'version',
        ];
    }
}
