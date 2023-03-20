<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Badges\OpenCollective\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

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
            'label'        => 'backers',
            'message'      => FormatNumber::execute($response['backersCount']),
            'messageColor' => 'green.600',
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
            '/opencollective/{slug}/backers',
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
            '/opencollective/webpack/backers' => 'backers',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}