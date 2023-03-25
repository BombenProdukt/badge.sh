<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge;

use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://sourceforge.net')->throw();
    }

    public function stats(string $project, ?string $folder, int $days): array
    {
        $stats = $folder ? "{$folder}/stats/json" : 'stats/json';

        return $this->client->get("projects/{$project}/files/{$stats}", [
            'start_date' => ($days === 0 ? Carbon::createFromTimestamp(0) : Carbon::now()->subDays($days))->toDateString(),
            'end_date' => Carbon::now()->toDateString(),
        ])->json();
    }
}
