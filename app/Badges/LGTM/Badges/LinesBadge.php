<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LinesBadge extends AbstractBadge
{
    protected array $routes = [
        '/lgtm/lines/{provider:bitbucket,github,gitlab}/{project:wildcard}/{language?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $provider, string $project, ?string $language = null): array
    {
        $response = $this->client->get($provider, $project, $language);

        return [
            'lines' => $language ? $response['lines'] : \array_reduce($response['languages'], fn ($accu, $curr) => $accu + $curr['lines'], 0),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLines($properties['lines']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'lines (java)',
                path: '/lgtm/lines/github/apache/cloudstack/java',
                data: $this->render(['lines' => '100000']),
            ),
        ];
    }
}
