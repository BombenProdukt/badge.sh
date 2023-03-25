<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Enums\Category;
use Illuminate\Support\Arr;

final class DocsBadge extends AbstractBadge
{
    protected array $routes = [
        '/cocoapods/doc-percent/{pod}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $pod): array
    {
        return [
            'percentage' => Arr::get($this->client->get($pod), 'cocoadocs.doc_percent', 0),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage($this->service(), $properties['percentage']);
    }

    public function previews(): array
    {
        return [
            '/cocoapods/doc-percent/AFNetworking' => 'documentation coverage (percentage)',
        ];
    }
}
