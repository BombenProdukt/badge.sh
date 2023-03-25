<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Spatie\Regex\Regex;

final class GoModBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/gomod/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

    public function handle(string $owner, string $repo): array
    {
        $response = \base64_decode(GitHub::repos()->contents()->show($owner, $repo, 'src/go.mod')['content'], true);

        return [
            'version' => Regex::match('/go (.+)/', $response)->group(1),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'go');
    }

    public function previews(): array
    {
        return [
            '/github/gomod/golang/go' => 'lerna',
        ];
    }
}
