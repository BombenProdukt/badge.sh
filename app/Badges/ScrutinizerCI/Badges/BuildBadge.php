<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BuildBadge extends AbstractBadge
{
    protected array $routes = [
        '/scrutinizer-ci/build/{vc:b,g,gl}/{user}/{repo}/{branch?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $user, string $repo, ?string $branch = 'master'): array
    {
        return $this->client->get($vcs, $user, $repo)['applications'][$branch]['build_status'];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'build',
                path: '/scrutinizer-ci/build/g/filp/whoops',
                data: $this->render(['status' => 'passing']),
            ),
        ];
    }
}
