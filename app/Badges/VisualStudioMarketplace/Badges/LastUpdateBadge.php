<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class LastUpdateBadge extends AbstractBadge
{
    protected string $route = '/vs-marketplace/last-modified/{extension}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $extension): array
    {
        return [
            'date' => $this->client->get($extension)['lastUpdated'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('last modified', $properties['date']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'last updated',
                path: '/vs-marketplace/last-modified/vscodevim.vim',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
