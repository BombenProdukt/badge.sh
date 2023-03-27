<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class UsernameBadge extends AbstractBadge
{
    protected string $route = '/devrant/score/{username}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $username): array
    {
        return $this->client->get($this->client->getUserIdFromName($username));
    }

    public function render(array $properties): array
    {
        return [
            'label' => \ucfirst($properties['username']),
            'message' => FormatNumber::execute((float) $properties['score']),
            'messageColor' => 'f99a66',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'score',
                path: '/devrant/score/Linuxxx',
                data: $this->render(['username' => 'Linuxxx', 'score' => '1000000']),
            ),
        ];
    }
}
