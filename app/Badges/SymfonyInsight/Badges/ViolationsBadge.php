<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight\Badges;

use App\Badges\AbstractBadge;
use App\Badges\SymfonyInsight\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ViolationsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectUuid): array
    {
        $response = $this->client->get($projectUuid);

        $status                = $response['status'];
        $numViolations         = $response['numViolations'];
        $numCriticalViolations = $response['numCriticalViolations'];
        $numMajorViolations    = $response['numMajorViolations'];
        $numMinorViolations    = $response['numMinorViolations'];
        $numInfoViolations     = $response['numInfoViolations'];
        $label                 = 'violations';

        if ($status !== 'finished' && $status !== '') {
            return $this->renderText('violations', 'pending', 'gray.600');
        }

        if ($numViolations === 0) {
            return $this->renderText('violations', '0', 'green.600');
        }

        $messageColor     = 'gray.600';
        $violationSummary = [];

        if ($numInfoViolations > 0) {
            $violationSummary[] = $numInfoViolations.' info';
        }

        if ($numMinorViolations > 0) {
            array_unshift($violationSummary, $numMinorViolations.' minor');
            $messageColor = 'yellow.600';
        }

        if ($numMajorViolations > 0) {
            array_unshift($violationSummary, $numMajorViolations.' major');
            $messageColor = 'orange.600';
        }

        if ($numCriticalViolations > 0) {
            array_unshift($violationSummary, $numCriticalViolations.' critical');
            $messageColor = 'red.600';
        }

        return $this->renderText('violations', implode(', ', $violationSummary), $messageColor);
    }

    public function service(): string
    {
        return 'Symfony';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/symfony-insight/violations/{projectUuid}',
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
            '/symfony-insight/violations/825be328-29f8-44f7-a750-f82818ae9111' => 'violations',
        ];
    }
}
