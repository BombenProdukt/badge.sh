<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Badges\CodeClimate\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class TechDebtBadge implements Badge
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
            'label'       => 'technical debt',
            'status'      => FormatNumber::execute($ratio),
            'statusColor' => match (true) {
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
            '/codeclimate/{project}/tech-debt',
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
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
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
            '/codeclimate/codeclimate/codeclimate/tech-debt' => 'technical debt',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
