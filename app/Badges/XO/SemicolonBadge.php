<?php

declare(strict_types=1);

namespace App\Badges\XO;

use App\Data\BadgePreviewData;
use App\Enums\Keyword;
use Illuminate\Support\Arr;

final class SemicolonBadge extends AbstractBadge
{
    protected string $route = '/xo/semicolon/{name:wildcard}';

    protected array $keywords = [
        Keyword::CODE_STYLE,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [];
        }

        return [
            'semicolons' => Arr::get($response, 'xo.semicolon') ? 'enabled' : 'disabled',
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['semicolons'])) {
            return [
                'label' => 'xo',
                'message' => 'not enabled',
                'messageColor' => 'gray.600',
            ];
        }

        return [
            'label' => 'semicolons',
            'message' => $properties['semicolons'],
            'messageColor' => 'teal.400',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'semicolon',
                path: '/xo/semicolon/chalk',
                data: $this->render(['semicolons' => 'enabled']),
            ),
            new BadgePreviewData(
                name: 'semicolon',
                path: '/xo/semicolon/chalk',
                data: $this->render(['semicolons' => 'disabled']),
            ),
            new BadgePreviewData(
                name: 'semicolon',
                path: '/xo/semicolon/@tusbar/cache-control',
                data: $this->render(['semicolons' => 'enabled']),
            ),
            new BadgePreviewData(
                name: 'semicolon',
                path: '/xo/semicolon/@tusbar/cache-control',
                data: $this->render(['semicolons' => 'disabled']),
            ),
        ];
    }
}
