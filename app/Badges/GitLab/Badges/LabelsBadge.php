<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LabelsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo, string $label, ?string $state = null): array
    {
        $stateFilter = $state ? 'state:'.strtolower($state) : '';
        $response    = $this->client->graphql($repo, "issues(labelName:\"{$label}\", {$stateFilter}) { count } label(title: \"{$label}\"){ color }");

        return [
            'label'        => $label,
            'message'      => FormatNumber::execute($response['issues']['count']),
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'GitLab';
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
            '/gitlab/{repo}/issues/filter/label/{label}/{state?}',
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
        $route->where('repo', RoutePattern::CATCH_ALL->value);
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
            '/gitlab/NickBusey/HomelabOS/issues/filter/label/Bug'                  => 'issues by label',
            '/gitlab/NickBusey/HomelabOS/issues/filter/label/Enhancement/opened'   => 'open issues by label',
            '/gitlab/NickBusey/HomelabOS/issues/filter/label/Help%20wanted/closed' => 'closed issues by label',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
