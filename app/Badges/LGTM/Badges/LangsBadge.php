<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LangsBadge extends AbstractBadge
{
    protected array $routes = [
        '/lgtm/languages/{provider:bitbucket,github,gitlab}/{project:wildcard}/{language?}',
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

        \usort($response['languages'], fn ($a, $b) => $b['lines'] - $a['lines']);

        return [
            'languages' => \array_map(fn ($x) => $langLabelOverrides[$x['language']] ?? $x['language'], $response['languages']),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'languages',
            'message' => \implode(' | ', $properties['languages']),
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'langs',
                path: '/lgtm/languages/github/apache/cloudstack/java',
                data: $this->render(['languages' => ['JavaScript', 'HTML', 'CSS']]),
            ),
        ];
    }
}
