<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Badges\LGTM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LangsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $provider, string $owner, string $name, ?string $language = null): array
    {
        $response = $this->client->get($provider, $owner, $name, $language);

        usort($response['languages'], fn ($a, $b) => $b['lines'] - $a['lines']);

        return [
            'label'       => 'languages',
            'status'      => implode(' | ', array_map(fn ($x) => $langLabelOverrides[$x['language']] ?? $x['language'], $response['languages'])),
            'statusColor' => 'blue.600',
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
            '/lgtm/langs/{provider}/{owner}/{name}/{language?}',
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
            '/lgtm/langs/g/apache/cloudstack/java' => 'langs',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
