<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Shardbox\Client;
use Illuminate\Routing\Controller;

final class DependentsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $shard): array
    {
        preg_match('/Dependents[^>]*? class="count">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'        => 'dependents',
            'status'       => FormatNumber::execute((int) $matches[1]),
            'statusColor'  => 'green.600',
        ];
    }
}
