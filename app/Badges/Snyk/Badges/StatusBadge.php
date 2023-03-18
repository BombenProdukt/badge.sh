<?php

declare(strict_types=1);

namespace App\Badges\Snyk\Badges;

use App\Badges\Snyk\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $branch = null, ?string $targetFile = null): array
    {
        $svg = $this->client->get(implode('/', [$owner, $repo, $branch]), $targetFile);

        preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $matchesText);
        [$subject, $status] = $matchesText[1];

        if (! preg_match('/<path[^>]*?fill="([^"]+)"[^>]*?d="M[^0]/i', $svg, $matchesColor)) {
            return [];
        }

        $statusColor = trim(str_replace('#', '', $matchesColor[1]));

        if (is_null($status) || empty($statusColor)) {
            return [];
        }

        return [
            'label'       => $subject ?? 'vulnerabilities',
            'status'      => $status,
            'statusColor' => $statusColor,
        ];
    }

    public function service(): string
    {
        return 'Snyk';
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
            '/snyk/{owner}/{repo}/{branch?}/{targetFile?}',
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
        $route->where('targetFile', '.+');
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
            '/snyk/badgen/badgen.net'                                     => 'vulnerability scan',
            '/snyk/babel/babel/6.x'                                       => 'vulnerability scan (branch)',
            '/snyk/rollup/plugins/master/packages%2Falias%2Fpackage.json' => 'vulnerability scan (custom path)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
