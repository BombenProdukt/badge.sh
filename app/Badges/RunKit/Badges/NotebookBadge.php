<?php

declare(strict_types=1);

namespace App\Badges\RunKit\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class NotebookBadge extends AbstractBadge
{
    protected string $route = '/runkit/{owner}/{notebook}/{path:wildcard?}';

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $owner, string $notebook, ?string $path = null): array
    {
        return $this->client->get($owner, $notebook, $path);
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'],
            'message' => $properties['message'],
            'messageColor' => $properties['messageColor'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'metaweather (state)',
                path: '/runkit/vladimyr/metaweather/44418/state',
                data: $this->render(['label' => 'state', 'message' => 'sunny', 'messageColor' => 'yellow.600']),
            ),
            new BadgePreviewData(
                name: 'metaweather (temperature in °C)',
                path: '/runkit/vladimyr/metaweather/44418/temperature',
                data: $this->render(['label' => 'temperature', 'message' => '20', 'messageColor' => 'blue.600']),
            ),
            new BadgePreviewData(
                name: 'metaweather (temperature in °F)',
                path: '/runkit/vladimyr/metaweather/44418/temperature/f',
                data: $this->render(['label' => 'temperature', 'message' => '68', 'messageColor' => 'blue.600']),
            ),
            new BadgePreviewData(
                name: 'metaweather (wind in km/h)',
                path: '/runkit/vladimyr/metaweather/44418/wind',
                data: $this->render(['label' => 'wind', 'message' => '10', 'messageColor' => 'green.600']),
            ),
            new BadgePreviewData(
                name: 'metaweather (wind in mph)',
                path: '/runkit/vladimyr/metaweather/44418/wind/mph',
                data: $this->render(['label' => 'wind', 'message' => '6', 'messageColor' => 'green.600']),
            ),
            new BadgePreviewData(
                name: 'metaweather (humidity)',
                path: '/runkit/vladimyr/metaweather/44418/humidity',
                data: $this->render(['label' => 'humidity', 'message' => '50', 'messageColor' => 'orange.600']),
            ),
        ];
    }
}
