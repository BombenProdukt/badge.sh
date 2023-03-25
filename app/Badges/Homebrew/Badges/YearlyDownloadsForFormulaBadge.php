<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class YearlyDownloadsForFormulaBadge extends AbstractBadge
{
    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return [
            'downloads' => $this->client->get('formula', $package)['analytics']['install']['365d'][$package],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'downloads',
            'message' => FormatNumber::execute($properties['downloads']).'/year',
            'messageColor' => 'green.600',
        ];
    }

    public function routePaths(): array
    {
        return [
            '/homebrew/downloads-yearly/{package}',
            '/homebrew/downloads-yearly/formula/{package}',
            '/homebrew/downloads-yearly/cask/{package}',
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/homebrew/downloads-yearly/fish' => 'yearly downloads',
        ];
    }
}
