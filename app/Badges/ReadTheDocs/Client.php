<?php

declare(strict_types=1);

namespace App\Badges\ReadTheDocs;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://readthedocs.org')->throw();
    }

    public function status(string $project, ?string $version): string
    {
        return $this->client->get("projects/{$project}/badge", $version ? ['version' => $version] : [])->body();
    }
}
