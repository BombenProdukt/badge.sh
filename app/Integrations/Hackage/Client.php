<?php

declare(strict_types=1);

namespace App\Integrations\Hackage;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://hackage.haskell.org/')->throw();
    }

    public function get(string $package): array
    {
        return $this->parseCabalFile($this->client->get("package/{$package}/{$package}.cabal")->body());
    }

    private function parseCabalFile(string $raw): array
    {
        preg_match_all('/[\w-]+:.+\S+$/m', $raw, $matches);

        $parsed = array_reduce($matches[0], function ($accu, $line) {
            [$key, $value] = explode(':', $line, 2);
            $accu[$key]    = trim($value);

            return $accu;
        }, []);

        return $parsed;
    }
}
