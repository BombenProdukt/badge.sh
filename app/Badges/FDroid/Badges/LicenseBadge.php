<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Badges\AbstractBadge;
use App\Badges\FDroid\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        return $this->renderLicense($this->client->get($appId)['License']);
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
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/f-droid/license/{appId}',
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
            '/f-droid/license/org.tasks' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
