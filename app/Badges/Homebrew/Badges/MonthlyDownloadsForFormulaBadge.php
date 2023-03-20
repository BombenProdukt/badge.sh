<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Badges\Homebrew\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class MonthlyDownloadsForFormulaBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $count = $this->client->get('formula', $package)['analytics']['install']['30d'][$package];

        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/month',
            'messageColor' => 'green.600',
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
            '/homebrew/{package}/downloads/monthly',
            '/homebrew/formula/{package}/downloads/monthly',
            '/homebrew/cask/{package}/downloads/monthly',
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
            '/homebrew/fish/downloads/monthly' => 'monthly downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}