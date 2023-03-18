<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Actions\FormatMoney;
use App\Badges\Liberapay\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class GivesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => 'gives',
            'status'      => FormatMoney::execute((float) $response['giving']['amount'], $response['giving']['currency']).'/week',
            'statusColor' => 'yellow.600',
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/liberapay/gives/{username}',
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
            '/liberapay/gives/aurelienpierre' => 'giving',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
