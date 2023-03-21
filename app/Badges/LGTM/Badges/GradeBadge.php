<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\LGTM\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
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
            'label'        => 'code quality: '.($this->languages[$response['lines']] ?? $language),
            'message'      => $response['grade'],
            'messageColor' => [
                'A+' => 'green.600',
                'A'  => '9C0',
                'B'  => 'A4A61D',
                'C'  => 'yellow.600',
                'D'  => 'orange.600',
            ][$response['grade']],
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
            '/lgtm/grade/{provider}/{project}/{language?}',
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
            '/lgtm/grade/github/apache/cloudstack/java'              => 'grade (java)',
            '/lgtm/grade/github/apache/cloudstack'                   => 'grade (auto)',
            '/lgtm/grade/github/systemd/systemd'                     => 'grade (auto)',
            '/lgtm/grade/bitbucket/wegtam/bitbucket-youtrack-broker' => 'grade (auto)',
            '/lgtm/grade/gitlab/nekokatt/hikari'                     => 'grade (auto)',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
