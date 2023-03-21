<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Badges\AbstractBadge;
use App\Badges\FDroid\Client;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        $version = $this->client->get($appId)['CurrentVersion'];

        return $this->renderVersion($version);
    }

    public function service(): string
    {
        return 'F-Droid';
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
