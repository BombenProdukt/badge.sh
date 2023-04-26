<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/symfony-insight/stars/{projectUuid}';

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
            new BadgePreviewData(
                name: 'stars',
                path: '/symfony-insight/stars/825be328-29f8-44f7-a750-f82818ae9111',
                data: $this->render(['grade' => 'bronze']),
            ),
            new BadgePreviewData(
                name: 'stars',
                path: '/symfony-insight/stars/825be328-29f8-44f7-a750-f82818ae9111',
                data: $this->render(['grade' => 'silver']),
            ),
            new BadgePreviewData(
                name: 'stars',
                path: '/symfony-insight/stars/825be328-29f8-44f7-a750-f82818ae9111',
                data: $this->render(['grade' => 'gold']),
            ),
            new BadgePreviewData(
                name: 'stars',
                path: '/symfony-insight/stars/825be328-29f8-44f7-a750-f82818ae9111',
                data: $this->render(['grade' => 'platinum']),
            ),
            new BadgePreviewData(
                name: 'stars',
                path: '/symfony-insight/stars/825be328-29f8-44f7-a750-f82818ae9111',
                data: $this->render(['grade' => 'unknown']),
            ),
        ];
    }
}
