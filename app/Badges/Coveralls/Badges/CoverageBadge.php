<?php

declare(strict_types=1);

namespace App\Badges\Coveralls\Badges;

use App\Actions\ExtractCoverageColor;
use App\Actions\FormatPercentage;
use App\Badges\Coveralls\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CoverageBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vcs, string $owner, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($vcs, $owner, $repo, $branch);

        preg_match('/_(\d+)\.svg/', $response, $matches);

        if (! is_numeric($matches[1])) {
            return [
                'subject'     => 'coverage',
                'status'      => 'invalid',
                'statusColor' => 'gray.600',
            ];
        }

        return [
            'label'       => 'coverage',
            'status'      => FormatPercentage::execute($matches[1]),
            'statusColor' => ExtractCoverageColor::execute((float) $matches[1]),
        ];
    }

    public function service(): string
    {
        return 'Coveralls';
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
            '/coveralls/c/{vcs}/{owner}/{repo}/{branch?}',
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
        $route->whereIn('vcs', ['github', 'bitbucket']);
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
            '/coveralls/c/github/jekyll/jekyll'           => 'coverage (github)',
            '/coveralls/c/github/jekyll/jekyll/master'    => 'coverage (github, branch)',
            '/coveralls/c/bitbucket/pyKLIP/pyklip'        => 'coverage (bitbucket)',
            '/coveralls/c/bitbucket/pyKLIP/pyklip/master' => 'coverage (bitbucket, branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
