<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LanguageBadge extends AbstractBadge
{
    protected string $route = '/packagist/language/{vendor}/{project}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vendor, string $project): array
    {
        return $this->client->get($vendor, $project);
    }

    public function render(array $properties): array
    {
        return $this->renderText('language', $properties['language']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'language',
                path: '/packagist/language/monolog/monolog',
                data: $this->render(['language' => 'PHP']),
            ),
        ];
    }
}
