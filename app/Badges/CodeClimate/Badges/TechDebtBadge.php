<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class TechDebtBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeclimate/tech-debt/{project}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project): array
    {
        $response = $this->client->get($project, 'snapshots');

        return [
            'ratio' => $response['meta']['measures']['technical_debt_ratio']['value'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'technical debt',
            'message' => FormatNumber::execute($properties['ratio']),
            'messageColor' => match (true) {
                $properties['ratio'] <= 5 => 'green.600' ,
                $properties['ratio'] <= 10 => '9C1' ,
                $properties['ratio'] <= 20 => 'AA2' ,
                $properties['ratio'] <= 50 => 'DC2' ,
                default => 'orange.600',
            },
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'technical debt',
                path: '/codeclimate/tech-debt/codeclimate/codeclimate',
                data: $this->render([]),
            ),
        ];
    }
}
