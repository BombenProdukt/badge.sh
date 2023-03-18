<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Actions\FormatNumber;
use App\Badges\CodeClimate\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class TechDebtBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');
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
            '/codeclimate/tech-debt/{owner}/{repo}',
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
            '/codeclimate/tech-debt/codeclimate/codeclimate' => 'technical debt',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
