<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\GitLab\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->rest($owner, $repo, '?license=true');

        return [
            'label'       => 'license',
            'status'      => str_replace(' License', ' ', $response->json('license.name')),
            'statusColor' => 'blue.600',
        ];
    }
}
