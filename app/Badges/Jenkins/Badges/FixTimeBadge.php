<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Jenkins\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class FixTimeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $hostname, string $job): array
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
            'label'        => 'Fix Builds',
            'message'      => $fixTime,
            'messageColor' => match (true) {
                $statusColorTime < 2 => 'green.600',
                $statusColorTime < 6 => 'orange.600',
                default              => 'red.600',
            },
        ];
    }

    public function service(): string
    {
        return 'Jenkins';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/jenkins/fix-time/{hostname}/{job}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('job', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jenkins/fix-time/jenkins.mono-project.com/job/test-mono-mainline' => 'Time taken to fix a broken build',
        ];
    }
}
