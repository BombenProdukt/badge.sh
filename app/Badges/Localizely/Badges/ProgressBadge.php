<?php

declare(strict_types=1);

namespace App\Badges\Localizely\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ProgressBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        $response     = $this->client->get($this->getRequestData('token'), $projectId);
        $languageCode = $this->getRequestData('languageCode');

        if (empty($languageCode)) {
            return $this->renderPercentage('localized', $response['reviewedProgress']);
        }

        return $this->renderPercentage(
            $languageCode,
            collect($response['languages'])->find(fn (array $language) => $language['langCode'] === $languageCode)['reviewedProgress'],
        );
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/localizely/progress/{projectId}/{branch?}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'languageCode' => ['nullable', 'string'],
            'token'        => ['required', 'string'],
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('projectId', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/localizely/progress/5cc34208-0418-40b1-8353-acc70c95f802/main?token=0f4d5e31a44f48dcbab966c52cfb0a67c5f1982186c14b85ab389a031dbc225a'                    => 'progress',
            '/localizely/progress/5cc34208-0418-40b1-8353-acc70c95f802/main?token=0f4d5e31a44f48dcbab966c52cfb0a67c5f1982186c14b85ab389a031dbc225a&languageCode=en-US' => 'progress for language',
        ];
    }
}
