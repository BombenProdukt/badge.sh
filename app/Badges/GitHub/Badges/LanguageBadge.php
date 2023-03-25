<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

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
            '/github/language/micromatch/micromatch' => 'language',
        ];
    }
}
