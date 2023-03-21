<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class MilestonesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $milestoneNumber = ''): array
    {
        $milestone   = GitHub::api('issue')->milestones()->show($owner, $repo, $milestoneNumber);
        $openIssues  = $milestone['open_issues'];
        $totalIssues = $openIssues + $milestone['closed_issues'];

        return $this->renderPercentage(
            $milestone['title'],
            $totalIssues === 0 ? 0 : 100 - (($openIssues / $totalIssues) * 100),
        );
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/github/milestones/{owner}/{repo}/{milestoneNumber}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/milestones/chrislgarry/Apollo-11/1' => 'milestone percentage',

        ];
    }
}
