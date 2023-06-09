<?php

declare(strict_types=1);

namespace App\Badges\Jenkins;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class CoverageBadge extends AbstractBadge
{
    protected string $route = '/jenkins/coverage/{format:api,cobertura,jacoco}';

    protected array $keywords = [
        Category::COVERAGE,
    ];

    public function handle(string $format): array
    {
        $response = Http::get($this->getRequestData('job').'/lastCompletedBuild/api/json', match ($format) {
            'api' => ['tree' => 'results[elements[name,ratio]]'],
            'cobertura' => ['tree' => 'results[elements[name,ratio]]'],
            'jacoco' => ['tree' => 'instructionCoverage[shortDescription]'],
        })->throw()->json();

        return [
            'percentage' => match ($format) {
                'jacoco' => $response['instructionCoverage']['percentage'],
                default => collect($response['results']['elements'])->firstWhere('name', 'Lines')['ratio'],
            },
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage('percentage');
    }

    public function routeRules(): array
    {
        return [
            'job' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage',
                path: '/jenkins/coverage/api?job=https://jenkins.sqlalchemy.org/job/alembic_coverage',
                data: $this->render(['percentage' => '66.66']),
            ),
            new BadgePreviewData(
                name: 'coverage',
                path: '/jenkins/coverage/cobertura?job=https://jenkins.sqlalchemy.org/job/alembic_coverage',
                data: $this->render(['percentage' => '66.66']),
            ),
            new BadgePreviewData(
                name: 'coverage',
                path: '/jenkins/coverage/jacoco?job=https://jenkins.sqlalchemy.org/job/alembic_coverage',
                data: $this->render(['percentage' => '66.66']),
            ),
        ];
    }
}
