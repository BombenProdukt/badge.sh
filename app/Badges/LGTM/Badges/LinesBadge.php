<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\LGTM\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LinesBadge extends AbstractBadge
{
    private array $languages = [
        'cpp'        => 'c/c++',
        'csharp'     => 'c#',
        'javascript' => 'js/ts',
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $provider, string $project, ?string $language = null): array
    {
        dd($project);
        $response = $this->client->get($provider, $project, $language);

        return $this->renderLines(
            // $language ? 'lines: '.($this->languages[$response['lines']] ?? $language) : 'lines',
            $language ? $response['lines'] : array_reduce($response['languages'], fn ($accu, $curr) => $accu + $curr['lines'], 0),
        );
    }

    public function service(): string
    {
        return 'LGTM';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/lgtm/lines/{provider}/{project}/{language?}',
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
            '/lgtm/lines/github/apache/cloudstack/java' => 'lines (java)',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
