<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Pub\Client;
use Illuminate\Routing\Route;

final class SdkVersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $version = $this->client->api("packages/{$package}")['latest']['pubspec']['environment']['sdk'];

        return $this->renderVersion('dart sdk', $version);
    }

    public function service(): string
    {
        return 'Pub';
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
            '/pub/sdk-version/{package}',
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
            '/pub/sdk-version/uuid' => 'sdk-version',
        ];
    }
}
