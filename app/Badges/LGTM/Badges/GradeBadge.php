<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Badges\LGTM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class GradeBadge implements Badge
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

    public function handle(string $provider, string $owner, string $name, ?string $language = null): array
    {
        $response = $this->client->get($provider, $owner, $name, $language);

        return [
            'label'       => 'code quality: '.($this->languages[$response['lines']] ?? $language),
            'status'      => $response['grade'],
            'statusColor' => [
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/lgtm/grade/{provider}/{owner}/{name}/{language?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('provider', ['g', 'github', 'b', 'bitbucket', 'gl', 'gitlab']);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/lgtm/grade/g/apache/cloudstack/java'                   => 'grade (java)',
            '/lgtm/grade/g/apache/cloudstack'                        => 'grade (auto)',
            '/lgtm/grade/g/systemd/systemd'                          => 'grade (auto)',
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
