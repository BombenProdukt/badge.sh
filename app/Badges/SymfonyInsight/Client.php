<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Symfony\Component\DomCrawler\Crawler;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://insight.symfony.com/api')
            ->accept('application/vnd.com.sensiolabs.insight+xml')
            ->withBasicAuth(config('services.symfony_insight.username'), config('services.symfony_insight.password'))
            ->throw();
    }

    public function get(string $projectUuid): array
    {
        $lastAnalysis = (new Crawler($this->client->get("projects/{$projectUuid}")->json()))->filterXPath('//last_analysis')->first()->text();

        if (empty($lastAnalysis)) {
            throw new RuntimeException('No analysis found for this project.');
        }

        $numViolations         = 0;
        $numCriticalViolations = 0;
        $numMajorViolations    = 0;
        $numMinorViolations    = 0;
        $numInfoViolations     = 0;

        $violationContainer = $lastAnalysis['violations'];

        if ($violationContainer && $violationContainer['violation']) {
            $violations = [];

            if (is_array($violationContainer['violation'])) {
                $violations = $violationContainer['violation'];
            } else {
                $violations[] = $violationContainer['violation'];
            }

            $numViolations = count($violations);

            foreach ($violations as $violation) {
                if ($violation['severity'] === 'critical') {
                    $numCriticalViolations++;
                } elseif ($violation['severity'] === 'major') {
                    $numMajorViolations++;
                } elseif ($violation['severity'] === 'minor') {
                    $numMinorViolations++;
                } else {
                    $numInfoViolations++;
                }
            }
        }

        return [
            'status'                => $lastAnalysis['status'],
            'grade'                 => $lastAnalysis['grade'],
            'numViolations'         => $numViolations,
            'numCriticalViolations' => $numCriticalViolations,
            'numMajorViolations'    => $numMajorViolations,
            'numMinorViolations'    => $numMinorViolations,
            'numInfoViolations'     => $numInfoViolations,
        ];
    }
}
