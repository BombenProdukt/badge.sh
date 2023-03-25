<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class LanguageBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/language/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo): array
    {
        return GitHub::repos()->show($owner, $repo);
    }

    public function render(array $properties): array
    {
        return $this->renderText('language', $properties['language'], 'blue.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'language',
                path: '/github/language/micromatch/micromatch',
                data: $this->render(['language' => 'PHP']),
            ),
        ];
    }
}
