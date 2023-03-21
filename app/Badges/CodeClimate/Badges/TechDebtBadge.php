<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CodeClimate\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class TechDebtBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $response = $this->client->get($project, 'snapshots');
        $ratio    = $response['meta']['measures']['technical_debt_ratio']['value'];

        return [
            'label'        => 'technical debt',
            'message'      => FormatNumber::execute($ratio),
            'messageColor' => match (true) {
                $ratio <= 5  => 'green.600' ,
                $ratio <= 10 => '9C1' ,
                $ratio <= 20 => 'AA2' ,
                $ratio <= 50 => 'DC2' ,
                default      => 'orange.600',
            },
        ];
    }

    public function service(): string
    {
        return 'Code Climate';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/codeclimate/tech-debt/{project}',
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
            '/codeclimate/tech-debt/codeclimate/codeclimate' => 'technical debt',
        ];
    }
}
