<?php

declare(strict_types=1);

namespace App\Badges\OPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\OPM\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $moduleName): array
    {
        return $this->renderVersion(Regex::match("/{$moduleName}-(.+).opm/", $this->client->version($user, $moduleName))->group(1));
    }

    public function service(): string
    {
        return 'OPM';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/opm/version/{user}/{moduleName}',
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
            '/opm/version/openresty/lua-resty-lrucache' => 'version',
        ];
    }
}
