<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Badges\CodeClimate\Client;
use App\Badges\Templates\GradeTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CoverageLetterBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'test_reports');

        return GradeTemplate::make(
            'coverage',
            $response['attributes']['rating']['letter'],
            $response['attributes']['rating']['measure']['value'],
        );
    }

    public function service(): string
    {
        return 'Code Climate';
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
            '/codeclimate/coverage-letter/{owner}/{repo}',
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
            '/codeclimate/coverage-letter/codeclimate/codeclimate' => 'coverage (letter)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
