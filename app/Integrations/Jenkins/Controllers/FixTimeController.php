<?php

declare(strict_types=1);

namespace App\Integrations\Jenkins\Controllers;

use App\Integrations\Jenkins\Client;
use Illuminate\Routing\Controller;

final class FixTimeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $hostname, string $job): array
    {
        $builds = $this->client->builds($hostname, $job);

        $lastSuccessTime = 0;
        $lastFailTime    = 0;

        for ($index = 0; $index < count($builds); $index++) {
            $element = $builds[$index];

            if (strtolower($element['result']) == 'success') {
                $lastSuccessTime = $element['timestamp'];
                $lastFailTime    = $lastSuccessTime;
            } else {
                $lastFailTime = $element['timestamp'];
                break;
            }
        }
        if ($lastSuccessTime == 0) {
            $lastSuccessTime = time();
        }
        if ($lastFailTime == 0) {
            $lastFailTime = $lastSuccessTime;
        }

        $fixTime         = ($lastSuccessTime - $lastFailTime);
        $statusColorTime = ($fixTime / 3600000);

        return [
            'label'       => 'Fix Builds',
            'status'      => $fixTime,
            'statusColor' => match (true) {
                $statusColorTime < 2 => 'green.600',
                $statusColorTime < 6 => 'orange.600',
                default              => 'red.600',
            },
        ];
    }
}
