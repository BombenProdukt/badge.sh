<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Badges\AbstractBadge;
use App\Badges\OpenCollective\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class ContributorsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'        => 'contributors',
            'message'      => FormatNumber::execute($response['contributorsCount']),
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/opencollective/contributors/{slug}',
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
            '/opencollective/contributors/webpack' => 'contributors',
        ];
    }
}
