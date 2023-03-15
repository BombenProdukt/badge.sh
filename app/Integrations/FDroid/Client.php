<?php

declare(strict_types=1);

namespace App\Integrations\FDroid;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Yaml\Yaml;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://gitlab.com/fdroid/fdroiddata/raw/master/metadata/')->throw();
    }

    public function get(string $appId): array
    {
        return Yaml::parse($this->client->get("{$appId}.yml")->body());
    }
}
