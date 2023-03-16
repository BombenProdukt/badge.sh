<?php

declare(strict_types=1);

namespace App\Integrations\Matrix;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('')->throw();
    }

    public function fetchMembersCount(string $roomName, string $server): int
    {
        if ($server === 'gitter.im') {
            [$gitterOrg, $gitterRoom] = explode('_', $roomName);

            preg_match('/"userCount"\s*:\s*(\d+)/', $this->client->get("https://gitter.im/{$gitterOrg}/{$gitterRoom}")->body(), $matches);

            return (int) $matches[1];
        }

        $client = Http::baseUrl($this->getHomeserver($server).'/_matrix/client/r0');
        $room   = $this->findPublicRoom($client, "#{$roomName}:{$server}");

        return (int) $room['num_joined_members'];
    }

    private function getHomeserver(string $server): ?string
    {
        return Http::get("https://{$server}/.well-known/matrix/client")->json()['m.homeserver']['base_url'];
    }

    private function findPublicRoom(PendingRequest $client, string $roomAlias): ?array
    {
        $roomId       = $this->getRoomId($client, $roomAlias);
        $searchParams = ['query' => ['limit' => '500']];
        $nextBatch    = null;

        do {
            if ($nextBatch) {
                $searchParams['query']['since'] = $nextBatch;
            }

            $json      = $client->get('publicRooms', $searchParams)->json();
            $nextBatch = $json['next_batch'] ?? null;
            $chunk     = $json['chunk'] ?? [];

            foreach ($chunk as $room) {
                if ($room['room_id'] === $roomId) {
                    return $room;
                }
            }
        } while ($nextBatch);

        return null;
    }

    private function getRoomId(PendingRequest $client, string $roomAlias): ?string
    {
        return $client->get('directory/room/'.urlencode($roomAlias))->json('room_id');
    }
}
