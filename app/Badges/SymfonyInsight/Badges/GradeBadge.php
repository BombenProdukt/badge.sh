<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight\Badges;

use App\Badges\AbstractBadge;
use App\Badges\SymfonyInsight\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectUuid): array
    {
        return $this->renderGrade('grade', $this->client->get($projectUuid)['grade']);
    }

    public function service(): string
    {
        return 'Symfony';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/symfony-insight/grade/{projectUuid}',
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
            '/symfony-insight/grade/825be328-29f8-44f7-a750-f82818ae9111' => 'grade',
        ];
    }
}
