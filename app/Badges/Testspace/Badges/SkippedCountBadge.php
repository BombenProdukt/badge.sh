<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Testspace\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class SkippedCountBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $org, string $project, string $space): array
    {
        return $this->renderNumber('skipped', $this->client->get($org, $project, $space)['skipped'], 'yellow.600');
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
            '/testspace/skipped-count/{org}/{project}/{space}',
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
            '/testspace/skipped-count/swellaby/swellaby:testspace-sample/main' => 'skipped tests count',
        ];
    }
}
