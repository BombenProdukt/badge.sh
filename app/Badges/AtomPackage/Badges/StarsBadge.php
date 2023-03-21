<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AtomPackage\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class StarsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return [
            'label'        => 'stars',
            'message'      => FormatNumber::execute($this->client->get($package)['stargazers_count']),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Atom Package';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/apm/stars/{package}',
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
            '/apm/stars/linter' => 'stars',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
