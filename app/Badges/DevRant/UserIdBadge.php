<?php

declare(strict_types=1);

namespace App\Badges\DevRant;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class UserIdBadge extends AbstractBadge
{
    protected string $route = '/devrant/score/{userId:number}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $userId): array
    {
        return $this->client->get($userId);
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
                path: '/devrant/score/22941',
                data: $this->render(['username' => 'Linuxxx', 'score' => '1000000']),
            ),
        ];
    }
}
