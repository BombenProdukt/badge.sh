<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Controller;

final class MilestonesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, ?string $milestoneNumber = ''): array
    {
        $milestone   = GitHub::api('issue')->milestones()->show($owner, $repo, $milestoneNumber);
        $openIssues  = $milestone['open_issues'];
        $totalIssues = $openIssues + $milestone['closed_issues'];
        $percentage  = $totalIssues === 0 ? 0 : 100 - (($openIssues / $totalIssues) * 100);

        return [
            'label'       => $milestone['title'],
            'status'      => floor($percentage).'%',
            'statusColor' => ExtractCoverageColor::execute($percentage),
        ];
    }
}
