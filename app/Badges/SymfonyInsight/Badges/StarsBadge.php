<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight\Badges;

use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/symfony-insight/stars/{projectUuid}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectUuid): array
    {
        return $this->client->get($projectUuid);
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', match ($properties['grade']) {
            'bronze' => 1,
            'silver' => 2,
            'gold' => 3,
            'platinum' => 4,
            default => 0,
        });
    }

    public function previews(): array
    {
        return [
            '/symfony-insight/stars/825be328-29f8-44f7-a750-f82818ae9111' => 'stars',
        ];
    }
}
