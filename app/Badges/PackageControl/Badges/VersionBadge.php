<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PackageControl\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        return $this->renderVersion($this->client->get($appId)['versions'][0]['version']);
    }

    public function service(): string
    {
        return 'Package Control';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/f-droid/{appId}/version',
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
            '/f-droid/org.schabi.newpipe/version'    => 'version',
            '/f-droid/com.amaze.filemanager/version' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
