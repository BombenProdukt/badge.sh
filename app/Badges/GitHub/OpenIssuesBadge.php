<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class OpenIssuesBadge extends AbstractBadge
{
    protected string $route = '/github/open-issues/{owner}/{repo}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => $this->client->makeRepoQuery($owner, $repo, 'issues(states:[OPEN]) { totalCount }')['issues']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'open issues',
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => $properties['count'] === 0 ? 'green.600' : 'orange.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'open issues',
                path: '/github/open-issues/micromatch/micromatch',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
