<?php

declare(strict_types=1);

namespace App\Badges\OpenSSFScorecard\Badges;

use App\Enums\Category;

final class ScoreBadge extends AbstractBadge
{
    protected array $routes = [
        '/ossf-scorecard/score/{host}/{orgName}/{repoName}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

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
