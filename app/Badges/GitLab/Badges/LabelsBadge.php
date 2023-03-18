<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Actions\FormatNumber;
use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LabelsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, string $label, ?string $state = null): array
    {
        $stateFilter = $state ? 'state:'.strtolower($state) : '';
        $response    = $this->client->graphql($owner, $repo, "issues(labelName:\"{$label}\", {$stateFilter}) { count } label(title: \"{$label}\"){ color }");

        return [
            'label'       => $label,
            'status'      => FormatNumber::execute($response['issues']['count']),
            'statusColor' => 'blue.600',
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
            '/gitlab/label-issues/{owner}/{repo}/{label}/{state?}',
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
            '/gitlab/label-issues/NickBusey/HomelabOS/Bug'                  => 'issues by label',
            '/gitlab/label-issues/NickBusey/HomelabOS/Enhancement/opened'   => 'open issues by label',
            '/gitlab/label-issues/NickBusey/HomelabOS/Help%20wanted/closed' => 'closed issues by label',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
