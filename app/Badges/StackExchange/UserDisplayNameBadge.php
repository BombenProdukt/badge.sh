<?php

declare(strict_types=1);

namespace App\Badges\StackExchange;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UserDisplayNameBadge extends AbstractBadge
{
    protected string $route = '/stack-exchange/user/display-name/{site}/{query}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return [
            'name' => $this->client->user($site, $query)['display_name'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('display-name', $properties['name']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'display-name',
                path: '/stack-exchange/user/display-name/stackoverflow/123',
                data: $this->render(['name' => 'John Doe']),
            ),
        ];
    }
}
