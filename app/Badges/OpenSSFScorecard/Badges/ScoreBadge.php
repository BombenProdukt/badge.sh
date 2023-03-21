<?php

declare(strict_types=1);

namespace App\Badges\OpenSSFScorecard\Badges;

use App\Badges\AbstractBadge;
use App\Badges\OpenSSFScorecard\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ScoreBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $host, string $orgName, string $repoName): array
    {
        return $this->renderNumber('score', $this->client->score($host, $orgName, $repoName));
    }

    public function service(): string
    {
        return 'OpenSSF Scorecard';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/ossf-scorecard/score/{host}/{orgName}/{repoName}',
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
            '/ossf-scorecard/score/github.com/rohankh532/org-workflow-add' => 'version',
        ];
    }
}
