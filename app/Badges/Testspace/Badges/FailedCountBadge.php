<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Testspace\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class FailedCountBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $org, string $project, string $space): array
    {
        return $this->renderNumber('failed', $this->client->get($org, $project, $space)['failed']);
    }

    public function service(): string
    {
        return 'Testspace';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/testspace/failed-count/{org}/{project}/{space}',
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
            '/testspace/failed-count/swellaby/swellaby:testspace-sample/main' => 'failed tests count',
        ];
    }
}
