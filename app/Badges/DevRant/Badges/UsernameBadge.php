<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class UsernameBadge extends AbstractBadge
{
    protected array $routes = [
        '/devrant/score/{username}',
    ];

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
            'message' => FormatNumber::execute($properties['score']),
            'messageColor' => 'f99a66',
        ];
    }

    public function previews(): array
    {
        return [
            '/devrant/score/Linuxxx' => 'score',
        ];
    }
}
