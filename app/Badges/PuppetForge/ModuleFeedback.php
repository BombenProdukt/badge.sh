<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ModuleFeedback extends AbstractBadge
{
    protected string $route = '/puppetforge/module-feedback/{user}/{module}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $user, string $module): array
    {
        return [
            'score' => $this->client->module($user, $module)['feedback_score'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('feedback score', $properties['score']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'feedback',
                path: '/puppetforge/module-feedback/camptocamp/openldap',
                data: $this->render(['score' => '1']),
            ),
        ];
    }
}
