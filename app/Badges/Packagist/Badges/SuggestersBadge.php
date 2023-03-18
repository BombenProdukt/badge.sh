<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Actions\FormatNumber;
use App\Badges\Packagist\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class SuggestersBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vendor, string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $package);

        return [
            'label'       => 'suggesters',
            'status'      => FormatNumber::execute($packageMeta['suggesters']),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Packagist';
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
            '/packagist/suggesters/{vendor}/{package}',
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
            '/packagist/suggesters/monolog/monolog' => 'suggesters',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
