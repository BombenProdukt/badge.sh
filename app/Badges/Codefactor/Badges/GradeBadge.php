<?php

declare(strict_types=1);

namespace App\Badges\Codefactor\Badges;

use App\Enums\Category;
use Spatie\Regex\Regex;

final class GradeBadge extends AbstractBadge
{
    protected array $routes = [
        '/codefactor/grade/{vcs}/{user}/{repo}/{branch?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $user, string $repo, ?string $channel = 'main'): array
    {
        return [
            'grade' => Regex::match('|<text x="78" y="14">([A-Z]+)</text>|', $this->client->get($vcs, $user, $repo, $channel))->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('code quality', $properties['grade']);
    }

    public function previews(): array
    {
        return [
            '/codefactor/grade/github/microsoft/powertoys' => 'grade',
            '/codefactor/grade/github/microsoft/powertoys/main' => 'grade (branch)',
        ];
    }
}
