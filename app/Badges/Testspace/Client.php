<?php

declare(strict_types=1);

namespace App\Badges\Testspace;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $org, string $project, string $space): array
    {
        $counts = Http::get("https://{$org}.testspace.com/api/projects/{$project}/spaces/{$space}/results")->throw()->json('0.case_counts');

        return [
            'passed' => $counts[0],
            'failed' => $counts[1],
            'skipped' => $counts[2],
            'errored' => $counts[3],
            'untested' => $counts[4],
            'total' => $counts[0] + $counts[1] + $counts[2] + $counts[3] + $counts[4],
        ];
    }
}
