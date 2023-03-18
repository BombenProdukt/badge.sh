<?php

declare(strict_types=1);

namespace App\Badges\Jenkins;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $hostname, string $job, string $path): array
    {
        return Http::get("https://{$hostname}/{$job}/{$path}")->throw()->json();
    }

    public function builds(string $hostname, string $job): array
    {
        return Http::get("https://{$hostname}/{$job}/api/json?tree=builds[number,status,timestamp,id,result]")->throw()->json('builds');
    }
}
