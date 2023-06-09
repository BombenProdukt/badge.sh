<?php

declare(strict_types=1);

namespace App\Badges\Date;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class RelativeBadge extends AbstractBadge
{
    protected string $route = '/date/relative/{timestamp:number}';

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $timestamp): array
    {
        return [
            'timestamp' => $timestamp,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('date', $properties['timestamp']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'relative date',
                path: '/date/relative/1540814400',
                data: $this->render(['timestamp' => Carbon::now()->unix()]),
            ),
        ];
    }
}
