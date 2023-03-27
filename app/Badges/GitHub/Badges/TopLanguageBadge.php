<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class TopLanguageBadge extends AbstractBadge
{
    protected string $route = '/github/top-language/{owner}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo): array
    {
        $languages = GitHub::repos()->languages($owner, $repo);

        return [
            'label' => \array_key_first($languages),
            'value' => head($languages),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['label'], $properties['value']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'top language',
                path: '/github/top-language/micromatch/micromatch',
                data: $this->render(['label' => 'JavaScript', 'value' => '100']),
            ),
        ];
    }
}
