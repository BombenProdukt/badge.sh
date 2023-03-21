<?php

declare(strict_types=1);

namespace App\Badges\JitPack\Badges;

use App\Badges\AbstractBadge;
use App\Badges\JitPack\Client;
use App\Badges\Templates\VersionTemplate;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $groupId, string $artifactId): array
    {
        return VersionTemplate::make($this->service(), $this->client->version($groupId, $artifactId));
    }

    public function service(): string
    {
        return 'JitPack';
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
            '/jitpack/version/{groupId}/{artifactId}',
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
            '/jitpack/version/com.github.jitpack/maven-simple' => 'version',
        ];
    }
}
