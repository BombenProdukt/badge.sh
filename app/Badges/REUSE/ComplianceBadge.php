<?php

declare(strict_types=1);

namespace App\Badges\REUSE;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ComplianceBadge extends AbstractBadge
{
    protected string $route = '/reuse/compliance/{remote:wildcard}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $remote): array
    {
        return $this->client->get($remote);
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('reuse', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'compliance',
                path: '/reuse/compliance/github.com/fsfe/reuse-tool',
                data: $this->render(['status' => 'compliant']),
            ),
        ];
    }
}
