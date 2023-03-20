<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Badges\Liberapay\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;

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
            'label'        => 'gives',
            'message'      => FormatMoney::execute((float) $response['giving']['amount'], $response['giving']['currency']).'/week',
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/liberapay/{username}/gives',
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
            '/liberapay/aurelienpierre/gives' => 'giving',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}