<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class HitsBadge extends AbstractBadge
{
    protected string $route = '/jsdelivr/hits/{platform}/{package:wildcard}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $platform, string $package): array
    {
        return [
            'count' => $this->client->data($platform, $package)['total'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'jsDelivr',
            'message' => FormatNumber::execute((float) $properties['count']).'/month',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'hits (per month)',
                path: '/jsdelivr/hits/gh/jquery/jquery',
                data: $this->render(['count' => 1000000000]),
            ),
            new BadgePreviewData(
                name: 'hits (per month)',
                path: '/jsdelivr/hits/npm/lodash',
                data: $this->render(['count' => 1000000000]),
            ),
        ];
    }
}
