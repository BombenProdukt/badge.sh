<?php

declare(strict_types=1);

namespace App\Badges\XO;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class IndentBadge extends AbstractBadge
{
    protected string $route = '/xo/indentation/{name:wildcard}';

    protected array $keywords = [
        Category::CODE_FORMATTING,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [];
        }

        return [
            'indentation' => $this->getIndent($response['xo']['space'] ?? false),
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['indentation'])) {
            return [
                'label' => 'xo',
                'message' => 'not enabled',
                'messageColor' => 'gray.600',
            ];
        }

        return [
            'label' => 'indentation',
            'message' => $properties['indentation'],
            'messageColor' => 'teal.400',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'indentation',
                path: '/xo/indentation/chalk',
                data: $this->render(['indentation' => 'tab']),
            ),
            new BadgePreviewData(
                name: 'indentation',
                path: '/xo/indentation/chalk',
                data: $this->render(['indentation' => '1 space']),
            ),
            new BadgePreviewData(
                name: 'indentation',
                path: '/xo/indentation/chalk',
                data: $this->render(['indentation' => '2 spaces']),
            ),
            new BadgePreviewData(
                name: 'indentation',
                path: '/xo/indentation/@tusbar/cache-control',
                data: $this->render(['indentation' => 'tab']),
            ),
            new BadgePreviewData(
                name: 'indentation',
                path: '/xo/indentation/@tusbar/cache-control',
                data: $this->render(['indentation' => '1 space']),
            ),
            new BadgePreviewData(
                name: 'indentation',
                path: '/xo/indentation/@tusbar/cache-control',
                data: $this->render(['indentation' => '2 spaces']),
            ),
        ];
    }

    private function getIndent(bool|int $space): string
    {
        if ($space === false) {
            return 'tab';
        }

        if ($space === true) {
            return '2 spaces';
        }

        if ($space === 1) {
            return '1 space';
        }

        return "{$space} spaces";
    }
}
