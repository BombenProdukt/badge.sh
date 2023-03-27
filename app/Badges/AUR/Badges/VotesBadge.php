<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VotesBadge extends AbstractBadge
{
    protected string $route = '/aur/votes/{package}';

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
            new BadgePreviewData(
                name: 'votes',
                path: '/aur/votes/google-chrome',
                data: $this->render(['votes' => '1000000']),
            ),
        ];
    }
}
