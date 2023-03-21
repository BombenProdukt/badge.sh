<?php

declare(strict_types=1);

namespace App\Badges\OpenSSFScorecard\Badges;

use App\Badges\OpenSSFScorecard\Client;
use App\Badges\Templates\NumberTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ScoreBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $host, string $orgName, string $repoName): array
    {
        return NumberTemplate::make('score', $this->client->score($host, $orgName, $repoName));
    }

    public function service(): string
    {
        return 'OpenSSF Scorecard';
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
            '/ossf-scorecard/score/{host}/{orgName}/{repoName}',
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
            '/ossf-scorecard/score/github.com/rohankh532/org-workflow-add' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}