<?php

declare(strict_types=1);

namespace App\Badges\Bugzilla\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/bugzilla/status/{bug}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $bug): array
    {
        $response = $this->client->get($bug);

        return [
            'bug' => $bug,
            'status' => \mb_strtolower($response['status'] === 'RESOLVED' ? $response['resolution'] : $response['status']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText(
            'bug '.$properties['bug'],
            match ($properties['status']) {
                'worksforme' => 'works for me',
                'wontfix' => "won't fix",
                default => $properties['status'],
            },
            match ($properties['status']) {
                'unconfirmed' => 'blue.600',
                'new' => 'blue.600',
                'assigned' => 'green.600',
                'fixed' => 'emerald.600',
                'invalid' => 'yellow.600',
                'wontfix' => 'orange.600',
                'duplicate' => 'slate.600',
                'worksforme' => 'lime.600',
                'incomplete' => 'red.600',
                default => 'gray.600',
            },
        );
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/bugzilla/status/996038',
                data: $this->render(['bug' => '996038', 'status' => 'fixed']),
            ),
        ];
    }
}
