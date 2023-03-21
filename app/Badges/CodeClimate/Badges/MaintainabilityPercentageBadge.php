<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CodeClimate\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MaintainabilityPercentageBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $response = $this->client->get($project, 'snapshots');

        return $this->renderGrade(
            'maintainability',
            $response['attributes']['ratings'][0]['measure']['value'],
            $response['attributes']['ratings'][0]['letter'],
        );
    }

    public function service(): string
    {
        return 'Code Climate';
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
            '/codeclimate/maintainability-percentage/{project}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/codeclimate/maintainability-percentage/codeclimate/codeclimate' => 'maintainability (percentage)',
        ];
    }
}
