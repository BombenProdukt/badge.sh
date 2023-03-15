<?php

declare(strict_types=1);

namespace App\Integrations\Gitter\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Gitter\Client;
use Illuminate\Routing\Controller;

final class MemberCountController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $org, string $room): array
    {
        preg_match('/"userCount"\s*:\s*(\d+)/', $this->client->get($org, $room), $matches);

        return [
            'label'       => 'gitter',
            'status'      => FormatNumber::execute((float) $matches[1][0]),
            'statusColor' => 'ed1965',
        ];
    }
}
