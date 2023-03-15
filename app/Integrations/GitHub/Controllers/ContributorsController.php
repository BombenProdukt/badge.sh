<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Controller;

final class ContributorsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        return [
            'label'       => 'contributors',
            'status'      => (string) count(GitHub::api('repo')->contributors($owner, $repo)),
            'statusColor' => 'blue.600',
        ];
    }
}
