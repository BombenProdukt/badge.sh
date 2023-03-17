<?php

declare(strict_types=1);

namespace App\Integrations\Jenkins\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Jenkins\Client;

final class BrokenBuildController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $hostname, string $job): array
    {
        $builds = collect($this->client->builds($hostname, $job))->filter(fn (array $build) => strtolower($build['result']) !== 'success');

        return [
            'label'       => 'Broken Builds',
            'status'      => FormatNumber::execute($builds->count()),
            'statusColor' => match (true) {
                $builds->count() < 10   => 'green.600',
                $builds->count() < 20   => 'orange.600',
                default                 => 'red.600',
            },
        ];
    }
}
