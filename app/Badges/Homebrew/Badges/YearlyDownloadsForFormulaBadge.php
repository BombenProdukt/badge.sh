<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Homebrew\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class YearlyDownloadsForFormulaBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $count = $this->client->get('formula', $package)['analytics']['install']['365d'][$package];

        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/year',
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Homebrew';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/homebrew/downloads-yearly/{package}',
            '/homebrew/downloads-yearly/formula/{package}',
            '/homebrew/downloads-yearly/cask/{package}',
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
            '/homebrew/downloads-yearly/fish' => 'yearly downloads',
        ];
    }
}
