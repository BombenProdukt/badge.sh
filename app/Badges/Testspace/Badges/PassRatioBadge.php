<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;

final class PassRatioBadge extends AbstractBadge
{
    protected array $routes = [
        '/testspace/pass-ratio/{org}/{project}/{space}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $org, string $project, string $space): array
    {
        $response = $this->client->get($org, $project, $space);

        return [
            'ratio' => ($response['passed'] / ($response['passed'] + $response['failed'] + $response['errored'])) * 100,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage($properties['ratio'] === 100 ? 'success' : 'critical', $properties['ratio']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/testspace/pass-ratio/swellaby/swellaby:testspace-sample/main' => 'pass ratio',
        ];
    }
}
