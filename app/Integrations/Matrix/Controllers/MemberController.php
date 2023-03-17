<?php

declare(strict_types=1);

namespace App\Integrations\Matrix\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Matrix\Client;
use Illuminate\Support\Str;

final class MemberController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $room, string $server = 'matrix.org'): array
    {
        $count = $this->client->fetchMembersCount($room, $server);

        return [
            'label'       => "#{$room}:{$server}",
            'status'      => FormatNumber::execute($count).' '.Str::plural('member', $count),
            'statusColor' => 'blue.600',
        ];
    }
}
