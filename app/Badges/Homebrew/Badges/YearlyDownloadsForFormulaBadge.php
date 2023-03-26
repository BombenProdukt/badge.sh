<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class YearlyDownloadsForFormulaBadge extends AbstractBadge
{
    protected array $routes = [
        '/homebrew/downloads-yearly/{type:cask,formula}/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $type, string $package): array
    {
        return [
            'downloads' => $this->client->get($type, $package)['analytics']['install']['365d'][$package],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'downloads',
            'message' => FormatNumber::execute((float) $properties['downloads']).'/year',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'yearly downloads',
                path: '/homebrew/downloads-yearly/formula/fish',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'yearly downloads',
                path: '/homebrew/downloads-yearly/cask/1password',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
