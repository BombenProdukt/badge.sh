<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BuildsBadge extends AbstractBadge
{
    protected string $route = '/visual-studio-app-center/builds/{owner}/{app}/{branch}/{token}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $owner, string $app, string $branch, string $token): array
    {
        return [
            'status' => $this->client->builds($owner, $app, $branch, $token),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build status', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'builds',
                path: '/visual-studio-app-center/builds/jct/my-amazing-app/master/ac70cv...',
                data: $this->render(['status' => 'succeeded']),
            ),
        ];
    }
}
