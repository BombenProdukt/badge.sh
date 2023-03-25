<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight\Badges;

use App\Enums\Category;

final class ViolationsBadge extends AbstractBadge
{
    protected array $routes = [
        '/symfony-insight/violations/{projectUuid}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectUuid): array
    {
        $response = $this->client->get($projectUuid);

        return [
            'status' => $response['status'],
            'number_of_violations' => $response['numViolations'],
            'number_of_critical_violations' => $response['numCriticalViolations'],
            'number_of_major_violations' => $response['numMajorViolations'],
            'number_of_minor_violations' => $response['numMinorViolations'],
            'number_of_info_violations' => $response['numInfoViolations'],
        ];
    }

    public function render(array $properties): array
    {
        $status = $properties['status'];
        $numViolations = $properties['number_of_violations'];
        $numCriticalViolations = $properties['number_of_critical_violations'];
        $numMajorViolations = $properties['number_of_major_violations'];
        $numMinorViolations = $properties['number_of_minor_violations'];
        $numInfoViolations = $properties['number_of_info_violations'];

        if ($status !== 'finished' && $status !== '') {
            return $this->renderText('violations', 'pending', 'gray.600');
        }

        if ($numViolations === 0) {
            return $this->renderText('violations', '0', 'green.600');
        }

        $messageColor = 'gray.600';
        $violationSummary = [];

        if ($numInfoViolations > 0) {
            $violationSummary[] = $numInfoViolations.' info';
        }

        if ($numMinorViolations > 0) {
            \array_unshift($violationSummary, $numMinorViolations.' minor');

            $messageColor = 'yellow.600';
        }

        if ($numMajorViolations > 0) {
            \array_unshift($violationSummary, $numMajorViolations.' major');

            $messageColor = 'orange.600';
        }

        if ($numCriticalViolations > 0) {
            \array_unshift($violationSummary, $numCriticalViolations.' critical');

            $messageColor = 'red.600';
        }

        return $this->renderText('violations', \implode(', ', $violationSummary), $messageColor);
    }

    public function previews(): array
    {
        return [
            '/symfony-insight/violations/825be328-29f8-44f7-a750-f82818ae9111' => 'violations',
        ];
    }
}
