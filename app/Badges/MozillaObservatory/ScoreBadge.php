<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ScoreBadge extends AbstractBadge
{
    protected string $route = '/mozilla-observatory/score/{host}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $host): array
    {
        return $this->client->get($host);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('observatory', $properties['score']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'score',
                path: '/mozilla-observatory/score/github.com',
                data: $this->render(['score' => '4.5']),
            ),
        ];
    }
}
