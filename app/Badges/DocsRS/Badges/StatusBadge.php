<?php

declare(strict_types=1);

namespace App\Badges\DocsRS\Badges;

use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/docsrs/version/{crate}/{version?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $crate, ?string $version = 'latest'): array
    {
        if ($this->client->status($crate, $version)) {
            return [
                'status' => 'passing',
                'version' => $version,
            ];
        }

        return [
            'status' => 'failing',
            'version' => $version,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('docs@'.$properties['version'], $properties['status']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/docsrs/version/regex' => 'version',
        ];
    }
}
