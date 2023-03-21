<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Modrinth\Client;
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

        return $this->renderVersion($this->service(), $version);
    }

    public function service(): string
    {
        return 'WIP';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/f-droid/version/{appId}',
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
            '/f-droid/version/org.schabi.newpipe'    => 'version',
            '/f-droid/version/com.amaze.filemanager' => 'version',
        ];
    }
}
