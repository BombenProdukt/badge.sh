<?php

declare(strict_types=1);

namespace App\Badges\Codacy\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Codacy\Client;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId, ?string $branch = null): array
    {
        preg_match('/visibility=[^>]*?>([^<]+)<\//i', $this->client->get('grade', $projectId, $branch), $matches);

        return $this->renderGrade('code quality', trim($matches[1]));
    }

    public function service(): string
    {
        return 'Codacy';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/codacy/grade/{projectId}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e'        => 'code quality',
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e/master' => 'branch code quality',
        ];
    }
}
