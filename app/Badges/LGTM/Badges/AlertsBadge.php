<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\LGTM\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class AlertsBadge extends AbstractBadge
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
        $response = $this->client->get($provider, $project, $language);

        return [
            'label'        => 'alerts: '.($this->languages[$response['lines']] ?? $language),
            'message'      => FormatNumber::execute($response['alerts']),
            'messageColor' => $response['alerts'] === 0 ? 'green.600' : 'yellow.600',
        ];
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/lgtm/alerts/{provider}/{project}/{language?}',
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
            '/lgtm/alerts/github/apache/cloudstack' => 'alerts',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
