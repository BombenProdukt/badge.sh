<?php

declare(strict_types=1);

namespace App\Badges\OpenSSFScorecard\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ScoreBadge extends AbstractBadge
{
    public function handle(string $host, string $orgName, string $repoName): array
    {
        return [
            'score' => $this->client->score($host, $orgName, $repoName),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('score', $properties['score']);
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
