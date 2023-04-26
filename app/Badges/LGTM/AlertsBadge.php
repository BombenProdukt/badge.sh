<?php

declare(strict_types=1);

namespace App\Badges\LGTM;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class AlertsBadge extends AbstractBadge
{
    protected string $route = '/lgtm/alerts/{provider:bitbucket,github,gitlab}/{project:wildcard}/{language?}';

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
            'alerts' => $response['alerts'],
            'language' => $this->languages[$response['lines']] ?? $language,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'alerts: '.$properties['language'],
            'message' => FormatNumber::execute((float) $properties['alerts']),
            'messageColor' => $properties['alerts'] === 0 ? 'green.600' : 'yellow.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'alerts',
                path: '/lgtm/alerts/github/apache/cloudstack',
                data: $this->render(['alerts' => '100', 'language' => 'java']),
                deprecated: true,
            ),
        ];
    }
}
