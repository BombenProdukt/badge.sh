<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Actions\FormatNumber;
use App\Badges\CodeClimate\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LocBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');

        return [
            'label'       => 'lines of code',
            'status'      => FormatNumber::execute($response['attributes']['lines_of_code']),
            'statusColor' => 'blue.600',
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
            '/codeclimate/loc/{owner}/{repo}',
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
            '/codeclimate/loc/codeclimate/codeclimate' => 'lines of code',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
