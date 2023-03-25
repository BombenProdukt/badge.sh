<?php

declare(strict_types=1);

namespace App\Badges\LGTM;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;
    private array $providers = [
        'github' => 'g',
        'bitbucket' => 'b',
        'gitlab' => 'gl',
    ];

    public function __construct()
    {
        $this->client = Http::baseUrl('https://lgtm.com/api/v1.0/')->throw();
    }

    public function get(string $provider, string $project, ?string $language): array
    {
        $provider = $this->providers[$provider] ?? $provider;

        return $this->detailsByLang($this->client->get("projects/{$provider}/{$project}")->json(), $language);
    }

    private function detailsByLang(array $data, ?string $lang): mixed
    {
        $found = $lang && \array_filter($data['languages'], function ($x) use ($lang) {
            return $x['language'] === $lang;
        });

        if ($found) {
            return $found[0];
        }

        return \array_reduce($data['languages'], function ($accu, $curr) {
            return $curr['lines'] > $accu['lines'] ? $curr : $accu;
        });
    }
}
