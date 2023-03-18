<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Actions\FormatNumber;
use App\Badges\Homebrew\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class YearlyDownloadsForFormulaBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $count = $this->client->get('formula', $package)['analytics']['install']['365d'][$package];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($count).'/year',
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Homebrew';
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
            '/homebrew/dy/{package}',
            '/homebrew/formula/dy/{package}',
            '/homebrew/cask/dy/{package}',
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
            '/homebrew/dy/fish' => 'yearly downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
