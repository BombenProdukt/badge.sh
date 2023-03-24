<?php

declare(strict_types=1);

namespace App\Badges\TeamCity;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function build(string $instance, string $buildId): array
    {
        $client = Http::baseUrl($instance)->throw();

        if (config('services.team_city.username') && config('services.team_city.password')) {
            $client->withBasicAuth(config('services.team_city.username'), config('services.team_city.password'));
        }

        return $client->get('app/rest/builds/'.urlencode("buildType:(id:{$buildId})"))->json();
    }

    public function coverage(string $instance, string $buildId): array
    {
        $client = Http::baseUrl($instance)->throw();

        if (config('services.team_city.username') && config('services.team_city.password')) {
            $client->withBasicAuth(config('services.team_city.username'), config('services.team_city.password'));
        }

        return $client->get('app/rest/builds/'.urlencode("buildType:(id:{$buildId})").'/statistics')->json('coverage');
    }
}
