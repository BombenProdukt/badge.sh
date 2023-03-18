<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Actions\FormatNumber;
use App\Badges\OpenCollective\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class BackersBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'       => 'backers',
            'status'      => FormatNumber::execute($response['backersCount']),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Open Collective';
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
            '/opencollective/backers/{slug}',
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
            '/opencollective/backers/webpack' => 'backers',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
