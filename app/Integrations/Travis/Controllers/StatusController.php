<?php

declare(strict_types=1);

namespace App\Integrations\Travis\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Travis\Client;
use Illuminate\Support\Collection;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $branch = null): array
    {
        $org = $this->client->org($owner, $repo, $branch);
        $com = $this->client->com($owner, $repo, $branch);

        $result = $this->availableStates()->firstWhere(fn (array $state) => str_contains($org, $state[0]) || str_contains($com, $state[0]));

        return [
            'label'       => 'travis',
            'status'      => $result[0],
            'statusColor' => $result[1],
        ];
    }

    private function availableStates(): Collection
    {
        return collect([
            ['broken', 'red.600'],
            ['canceled', 'grey.600'],
            ['error', 'red.600'],
            ['errored', 'red.600'],
            ['failed', 'red.600'],
            ['failing', 'red.600'],
            ['fixed', 'yellow.600'],
            ['passed', 'green.600'],
            ['passing', 'green.600'],
            ['pending', 'yellow.600'],
        ]);
    }
}
