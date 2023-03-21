<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Liberapay\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class PatronsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'        => 'patrons',
            'message'      => FormatNumber::execute($response['npatrons']),
            'messageColor' => 'yellow.600',
        ];
    }

    public function service(): string
    {
        return 'Liberapay';
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
            '/liberapay/patrons/{username}',
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
            '/liberapay/patrons/microG' => 'patrons count',
        ];
    }
}
