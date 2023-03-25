<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class AlertsBadge extends AbstractBadge
{
    protected array $routes = [
        '/lgtm/alerts/{provider}/{project}/{language?}',
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
            'alerts' => $response['alerts'],
            'language' => $this->languages[$response['lines']] ?? $language,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'alerts: '.$properties['language'],
            'message' => FormatNumber::execute($properties['alerts']),
            'messageColor' => $properties['alerts'] === 0 ? 'green.600' : 'yellow.600',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('provider', ['github', 'bitbucket', 'gitlab']);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'alerts',
                path: '/lgtm/alerts/github/apache/cloudstack',
                data: $this->render([]),
            ),
        ];
    }
}
