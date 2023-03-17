<?php

declare(strict_types=1);

namespace App\Integrations\Reddit\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Reddit\Client;

final class TotalKarmaController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $user): array
    {
        return [
            'label'       => "u/{$user}",
            'status'      => FormatNumber::execute($this->client->get("user/{$user}/about.json")['total_karma']).' karma',
            'statusColor' => 'ff4500',
        ];
    }
}
