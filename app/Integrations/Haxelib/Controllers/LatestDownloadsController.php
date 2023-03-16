<?php

declare(strict_types=1);

namespace App\Integrations\Haxelib\Controllers;

use App\Integrations\Haxelib\Client;
use Illuminate\Routing\Controller;

/**
 * @TODO
 */
final class LatestDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $project): array
    {
        $response = $this->client->get($project);

        return [
            'label'       => 'TODO',
            'status'      => 'TODO',
            'statusColor' => 'TODO',
        ];
    }
}
