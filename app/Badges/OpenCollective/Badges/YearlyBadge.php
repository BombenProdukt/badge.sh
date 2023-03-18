<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Actions\FormatMoney;
use App\Badges\OpenCollective\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class YearlyBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'       => 'yearly income',
            'status'      => FormatMoney::execute($response['yearlyIncome'] / 100, $response['currency']),
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
            '/opencollective/yearly/{slug}',
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
            '/opencollective/yearly/webpack' => 'yearly income',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
