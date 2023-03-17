<?php

declare(strict_types=1);

namespace App\Integrations\Gitter\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Gitter\Client;

final class MemberCountController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $org, string $room): array
    {
        preg_match('/"userCount"\s*:\s*(\d+)/', $this->client->get($org, $room), $matches);

        return [
            'label'       => 'gitter',
            'status'      => FormatNumber::execute((float) $matches[1][0]),
            'statusColor' => 'ed1965',
        ];
    }
}
