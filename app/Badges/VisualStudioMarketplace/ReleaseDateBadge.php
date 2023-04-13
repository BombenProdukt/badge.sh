<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

final class ReleaseDateBadge extends AbstractBadge
{
    protected string $route = '/vs-marketplace/release-date/{extension}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extension): array
    {
        return [
            'date' => $this->client->get($extension)['releaseDate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('release date', $properties['date']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'release date',
                path: '/vs-marketplace/release-date/vscodevim.vim',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
