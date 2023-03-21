<?php

declare(strict_types=1);

namespace App\Badges\ReadTheDocs\Badges;

use App\Badges\AbstractBadge;
use App\Badges\ReadTheDocs\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, ?string $version = null): array
    {
        return $this->renderStatus(
            'docs',
            Regex::match('|<text x="595" y="140" transform="scale\(.1\)" textLength="410">(.*)<\/text>|', $this->client->status($project, $version))->group(1),
        );
    }

    public function service(): string
    {
        return 'Read the Docs';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/readthedocs/status/{project}/{version?}',
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
            '/readthedocs/status/pip'        => 'status',
            '/readthedocs/status/pip/stable' => 'status',
        ];
    }
}
