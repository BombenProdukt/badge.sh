<?php

declare(strict_types=1);

namespace App\Badges\Steam;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.steampowered.com')->asForm()->throw();
    }

    public function collection(string $collectionId): array
    {
        return $this->client->post('ISteamRemoteStorage/GetCollectionDetails/v1?format=json', [
            'collectioncount' => '1',
            'publishedfileids[0]' => $collectionId,
        ])->json('response')['collectiondetails'][0];
    }

    public function file(string $fileId): array
    {
        return $this->client->post('ISteamRemoteStorage/GetPublishedFileDetails/v1?format=json', [
            'itemcount' => 1,
            'publishedfileids[0]' => $fileId,
        ])->json('response')['publishedfiledetails'][0];
    }
}
