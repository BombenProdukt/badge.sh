<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class QualityBadge extends AbstractBadge
{
    protected string $route = '/scrutinizer-ci/quality/{vcs:b,g,gl}/{user}/{repo}/{branch?}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $user, string $repo, ?string $branch = 'master'): array
    {
        return [
            'quality' => $this->client->get($vcs, $user, $repo)['applications'][$branch]['index']['_embedded']['project']['metric_values']['scrutinizer.quality'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('quality', $properties['quality']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'quality',
                path: '/scrutinizer-ci/quality/g/filp/whoops',
                data: $this->render(['quality' => 9.8]),
            ),
        ];
    }
}
