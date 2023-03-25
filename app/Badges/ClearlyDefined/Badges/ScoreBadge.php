<?php

declare(strict_types=1);

namespace App\Badges\ClearlyDefined\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ScoreBadge extends AbstractBadge
{
    protected array $routes = [
        '/clearlydefined/score/{type}/{provider}/{namespace}/{name}/{revision}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $type, string $provider, string $namespace, string $name, string $revision): array
    {
        return [
            'score' => $this->client->get($type, $provider, $namespace, $name, $revision)['scores']['effective'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('score', $properties['score']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'score',
                path: '/clearlydefined/score/npm/npmjs/-/jquery/3.4.1',
                data: $this->render([]),
            ),
        ];
    }
}
