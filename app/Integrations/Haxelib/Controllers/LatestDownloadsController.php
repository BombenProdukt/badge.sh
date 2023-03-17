<?php

declare(strict_types=1);

namespace App\Integrations\Haxelib\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Haxelib\Client;

/**
 * @TODO
 */
final class LatestDownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $project): array
    {
        $response = $this->client->get($project);

        return [
            'label'       => 'TODO',
            'status'      => 'TODO',
            'statusColor' => 'TODO',
        ];
    }
}
