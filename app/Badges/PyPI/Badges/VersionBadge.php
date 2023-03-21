<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\PyPI\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $version = $this->client->get($project)['info']['version'];

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'PyPI';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/pypi/version/{project}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/pypi/version/pip'      => 'version',
            '/pypi/version/docutils' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
