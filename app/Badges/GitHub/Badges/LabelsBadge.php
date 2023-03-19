<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LabelsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, string $label, ?string $states = ''): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, $this->getQueryBody($label, $states));

        return [
            'label'        => $label,
            'message'      => strval($result['label'] ? $result['label']['issues']['totalCount'] : 0),
            'messageColor' => $result['label'] ? $result['label']['color'] : 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'GitHub';
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
            '/github/{owner}/{repo}/issues/filter/label/{label}/{states?}',
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
        //
        $route->whereIn('states', ['open', 'closed']);
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
            '/github/nodejs/node/issues/filter/label/ES%20Modules'             => 'issues by label',
            '/github/atom/atom/issues/filter/label/help-wanted/open'           => 'open issues by label',
            '/github/rust-lang/rust/issues/filter/label/B-RFC-approved/closed' => 'closed issues by label',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }

    private function getQueryBody(string $label, string $states): string
    {
        $issueFilter = $states ? '(states:['.strtoupper($states).'])' : '';

        return "label(name:\"{$label}\") { color, issues{$issueFilter} { totalCount } }";
    }
}
