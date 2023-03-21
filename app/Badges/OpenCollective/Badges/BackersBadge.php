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

    public function handle(string $slug, ?string $tierId = null): array
    {
        $response = $this->client->fetchCollectiveBackersCount($slug, 'users', $tierId);

        return [
            'label'        => 'backers',
            'message'      => FormatNumber::execute($response),
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
            '/opencollective/backers/{slug}/{tierId?}',
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
