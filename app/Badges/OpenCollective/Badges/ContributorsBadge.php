<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Badges\OpenCollective\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class ContributorsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'       => 'contributors',
            'status'      => FormatNumber::execute($response['contributorsCount']),
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
            '/opencollective/{slug}/contributors',
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
            '/opencollective/webpack/contributors' => 'contributors',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
