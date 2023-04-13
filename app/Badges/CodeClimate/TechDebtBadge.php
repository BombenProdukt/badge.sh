<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class TechDebtBadge extends AbstractBadge
{
    protected string $route = '/codeclimate/tech-debt/{user}/{repo}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo): array
    {
        $response = $this->client->get($user, $repo, 'snapshots');

        return [
            'ratio' => $response['meta']['measures']['technical_debt_ratio']['value'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'technical debt',
            'message' => FormatNumber::execute((float) $properties['ratio']),
            'messageColor' => match (true) {
                $properties['ratio'] <= 5 => 'green.600',
                $properties['ratio'] <= 10 => '9C1',
                $properties['ratio'] <= 20 => 'AA2',
                $properties['ratio'] <= 50 => 'DC2',
                default => 'orange.600',
            },
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'technical debt',
                path: '/codeclimate/tech-debt/codeclimate/codeclimate',
                data: $this->render(['ratio' => '0']),
            ),
            new BadgePreviewData(
                name: 'technical debt',
                path: '/codeclimate/tech-debt/codeclimate/codeclimate',
                data: $this->render(['ratio' => '5']),
            ),
            new BadgePreviewData(
                name: 'technical debt',
                path: '/codeclimate/tech-debt/codeclimate/codeclimate',
                data: $this->render(['ratio' => '10']),
            ),
            new BadgePreviewData(
                name: 'technical debt',
                path: '/codeclimate/tech-debt/codeclimate/codeclimate',
                data: $this->render(['ratio' => '20']),
            ),
            new BadgePreviewData(
                name: 'technical debt',
                path: '/codeclimate/tech-debt/codeclimate/codeclimate',
                data: $this->render(['ratio' => '50']),
            ),
        ];
    }
}
