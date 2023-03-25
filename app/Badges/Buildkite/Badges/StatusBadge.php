<?php

declare(strict_types=1);

namespace App\Badges\Buildkite\Badges;

use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/buildkite/status/{identifier}/{branch?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $identifier, ?string $branch = null): array
    {
        return [
            'status' => $this->client->status($identifier, $branch),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function previews(): array
    {
        return [
            '/buildkite/status/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489' => 'build status',
            '/buildkite/status/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489/master' => 'build status',
        ];
    }
}
