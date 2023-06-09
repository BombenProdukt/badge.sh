<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TagBadge extends AbstractBadge
{
    protected string $route = '/github/tag/{owner}/{repo}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'refs(last: 1, refPrefix: "refs/tags/", orderBy: { field: TAG_COMMIT_DATE, direction: ASC }) { edges { node { name } } }');

        return [
            'version' => $result['refs']['edges'][0]['node']['name'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'latest tag',
                path: '/github/tag/micromatch/micromatch',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
