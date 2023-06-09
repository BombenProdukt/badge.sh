<?php

declare(strict_types=1);

namespace App\Badges\RubyGems;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class NameBadge extends AbstractBadge
{
    protected string $route = '/rubygems/name/{gem}';

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $gem): array
    {
        return $this->client->get("gems/{$gem}");
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'name',
            'message' => $properties['name'],
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'name',
                path: '/rubygems/name/rails',
                data: $this->render(['name' => 'rails']),
            ),
        ];
    }
}
