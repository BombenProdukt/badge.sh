<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LangsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/lgtm/languages/{provider}/{project}/{language?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('provider', ['github', 'bitbucket', 'gitlab']);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/lgtm/languages/github/apache/cloudstack/java' => 'langs',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
