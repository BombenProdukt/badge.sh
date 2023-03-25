<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Enums\Category;

final class VotesBadge extends AbstractBadge
{
    protected array $routes = [
        '/aur/votes/{package}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package): array
    {
        return [
            'votes' => $this->client->get($package)['NumVotes'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('votes', $properties['votes']);
    }

    public function previews(): array
    {
        return [
            '/aur/votes/google-chrome' => 'votes',
        ];
    }
}
