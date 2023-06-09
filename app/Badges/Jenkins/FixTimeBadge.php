<?php

declare(strict_types=1);

namespace App\Badges\Jenkins;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FixTimeBadge extends AbstractBadge
{
    protected string $route = '/jenkins/fix-time/{hostname}/{job:wildcard}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $hostname, string $job): array
    {
        $builds = $this->client->builds($hostname, $job);

        $lastSuccessTime = 0;
        $lastFailTime = 0;

        for ($index = 0; $index < \count($builds); $index++) {
            $element = $builds[$index];

            if (\mb_strtolower($element['result']) === 'success') {
                $lastSuccessTime = $element['timestamp'];
                $lastFailTime = $lastSuccessTime;
            } else {
                $lastFailTime = $element['timestamp'];

                break;
            }
        }

        if ($lastSuccessTime === 0) {
            $lastSuccessTime = \time();
        }

        if ($lastFailTime === 0) {
            $lastFailTime = $lastSuccessTime;
        }

        $fixTime = ($lastSuccessTime - $lastFailTime);
        $statusColorTime = ($fixTime / 3600000);

        return [
            'fixTime' => $fixTime,
            'statusColorTime' => $statusColorTime,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'Fix Builds',
            'message' => $properties['fixTime'],
            'messageColor' => match (true) {
                $properties['statusColorTime'] < 2 => 'green.600',
                $properties['statusColorTime'] < 6 => 'orange.600',
                default => 'red.600',
            },
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'Time taken to fix a broken build',
                path: '/jenkins/fix-time/jenkins.mono-project.com/job/test-mono-mainline',
                data: $this->render(['fixTime' => '0', 'statusColorTime' => '0']),
            ),
        ];
    }
}
