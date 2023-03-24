<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class PostKarmaBadge extends AbstractBadge
{
    public function handle(string $user): array
    {
        return [
            'username' => $user,
            'karma'    => $this->client->get("user/{$user}/about.json")['link_karma'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'u/'.$properties['username'],
            'message'      => FormatNumber::execute($properties['karma']).' post karma',
            'messageColor' => 'ff4500',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/reddit/post-karma/{user}',
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
            '/reddit/post-karma/spez' => 'post karma',
        ];
    }
}
