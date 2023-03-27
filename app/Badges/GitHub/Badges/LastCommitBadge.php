<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;

final class LastCommitBadge extends AbstractBadge
{
    protected string $route = '/github/last-commit/{owner}/{repo}/{reference?}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $owner, string $repo, ?string $reference = null): array
    {
        if (empty($reference)) {
            $response = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $result = $this->client->makeRepoQuery($owner, $repo, "branch: ref(qualifiedName: \"{$reference}\") { target { ... on Commit { history(first: 1) { nodes { committedDate } } } } }");

        return [
            'date' => $result['branch']['target']['history']['nodes'][0]['committedDate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last commit', $properties['date']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'last commit',
                path: '/github/last-commit/micromatch/micromatch',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
            new BadgePreviewData(
                name: 'last commit (branch ref)',
                path: '/github/last-commit/micromatch/micromatch/gh-pages',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
            new BadgePreviewData(
                name: 'last commit (tag ref)',
                path: '/github/last-commit/micromatch/micromatch/4.0.1',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
