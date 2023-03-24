<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SummaryBadge extends AbstractBadge
{
    public function handle(string $org, string $project, string $space): array
    {
        $response = $this->client->get($org, $project, $space);

        return $this->renderText('summary', $this->getMessage($response), $this->getMessageColor($response));
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/testspace/summary/{org}/{project}/{space}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/testspace/summary/swellaby/swellaby:testspace-sample/main' => 'pass ratio',
        ];
    }

    private function getMessage(array $response): string
    {
        $passed       = $response['passed'];
        $failed       = $response['failed'];
        $skipped      = $response['skipped'];
        $total        = $response['total'];
        $passedLabel  = $response['passedLabel'] ?? 'passed';
        $failedLabel  = $response['failedLabel'] ?? 'failed';
        $skippedLabel = $response['skippedLabel'] ?? 'skipped';
        $isCompact    = $response['isCompact'] ?? false;

        if ($total === 0) {
            return 'no tests';
        }

        if ($isCompact) {
            $passedLabel  = '✔';
            $failedLabel  = '✘';
            $skippedLabel = '➟';

            return implode(' | ', array_filter([
                "$passedLabel $passed",
                $failed > 0 ? "$failedLabel $failed" : null,
                $skipped > 0 ? "$skippedLabel $skipped" : null,
            ]));
        }

        return implode(', ', array_filter([
            "$passed $passedLabel",
            $failed > 0 ? "$failed $failedLabel" : null,
            $skipped > 0 ? "$skipped $skippedLabel" : null,
        ]));
    }

    private function getMessageColor(array $response): string
    {
        if ($response['total'] === 0) {
            return 'yellow.600';
        }

        if ($response['failed'] > 0) {
            return 'red.600';
        }

        if ($response['skipped'] > 0 && $response['passed'] > 0) {
            return 'green.600';
        }

        if ($response['skipped'] > 0) {
            return 'yellow.600';
        }

        return 'blue.600';
    }
}
