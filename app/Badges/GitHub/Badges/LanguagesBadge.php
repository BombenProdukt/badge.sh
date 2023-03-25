<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class LanguagesBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/languages/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'languages' => \array_keys(GitHub::repos()->languages($owner, $repo)),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('languages', \implode(' | ', $properties['languages']), 'blue.600');
    }

    public function previews(): array
    {
        return [
            '/github/languages/micromatch/micromatch' => 'languages',
        ];
    }
}
