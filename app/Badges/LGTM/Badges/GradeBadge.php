<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
{
    protected array $routes = [
        '/lgtm/grade/{provider}/{project}/{language?}',
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
            'language' => $this->languages[$response['lines']] ?? $language,
            'grade' => $response['grade'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'code quality: '.$properties['language'],
            'message' => $properties['grade'],
            'messageColor' => [
                'A+' => 'green.600',
                'A' => '9C0',
                'B' => 'A4A61D',
                'C' => 'yellow.600',
                'D' => 'orange.600',
            ][$properties['grade']],
        ];
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
            '/lgtm/grade/github/apache/cloudstack/java' => 'grade (java)',
            '/lgtm/grade/github/apache/cloudstack' => 'grade (auto)',
            '/lgtm/grade/github/systemd/systemd' => 'grade (auto)',
            '/lgtm/grade/bitbucket/wegtam/bitbucket-youtrack-broker' => 'grade (auto)',
            '/lgtm/grade/gitlab/nekokatt/hikari' => 'grade (auto)',
        ];
    }
}
