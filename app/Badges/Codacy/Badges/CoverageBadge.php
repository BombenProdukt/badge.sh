<?php

declare(strict_types=1);

namespace App\Badges\Codacy\Badges;

use App\Actions\ExtractCoverageColor;
use App\Actions\FormatPercentage;
use App\Badges\Codacy\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CoverageBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId, ?string $branch = null): array
    {
        preg_match('/text-anchor=[^>]*?>([^<]+)<\//i', $this->client->get('coverage', $projectId, $branch), $matches);

        $percentage = trim($matches[1]);

        return [
            'label'  => 'coverage',
            'status' => FormatPercentage::execute($percentage),
            'color'  => ExtractCoverageColor::execute((float) $percentage),
        ];
    }

    public function service(): string
    {
        return 'Codacy';
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
            '/codacy/coverage/{projectId}/{branch?}',
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
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e'        => 'coverage',
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e/master' => 'branch coverage',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
