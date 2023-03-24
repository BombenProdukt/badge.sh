<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Jenkins\Client;
use App\Enums\Category;
use Http;
use Illuminate\Routing\Route;

final class CoverageBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $format): array
    {
        $response = Http::get($this->getRequestData('job').'/lastCompletedBuild/api/json', match ($format) {
            'api'       => ['tree' => 'results[elements[name,ratio]]'],
            'cobertura' => ['tree' => 'results[elements[name,ratio]]'],
            'jacoco'    => ['tree' => 'instructionCoverage[shortDescription]'],
        })->throw()->json();

        return match ($format) {
            'jacoco' => $response['instructionCoverage']['percentage'],
            default  => collect($response['results']['elements'])->firstWhere('name', 'Lines')['ratio']
        };
    }

    public function service(): string
    {
        return 'Jenkins';
    }

    public function keywords(): array
    {
        return [Category::COVERAGE];
    }

    public function routePaths(): array
    {
        return [
            '/jenkins/coverage/{format}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'job' => ['required', 'url'],
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('format', ['api', 'cobertura', 'jacoco']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jenkins/coverage/api?job=https://jenkins.sqlalchemy.org/job/alembic_coverage'       => 'coverage',
            '/jenkins/coverage/cobertura?job=https://jenkins.sqlalchemy.org/job/alembic_coverage' => 'coverage',
            '/jenkins/coverage/jacoco?job=https://jenkins.sqlalchemy.org/job/alembic_coverage'    => 'coverage',
        ];
    }
}
