<?php

declare(strict_types=1);

namespace App\Badges\Endpoint;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Yaml;

final class YAMLBadge extends AbstractBadge
{
    protected string $route = '/endpoint/yaml';

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(): array
    {
        return Validator::make(
            Yaml::parse(Http::get($this->getRequestData('url'))->throw()->body()),
            [
                'schemaVersion' => ['required', 'in:1'],
                'label' => ['required', 'string'],
                'labelColor' => ['nullable', 'string'],
                'message' => ['required', 'string'],
                'messageColor' => ['required', 'string'],
                'style' => ['nullable', 'string'],
                'icon' => ['nullable', 'string'],
                'iconWidth' => ['nullable', 'integer'],
                'scale' => ['nullable', 'integer'],
            ],
        )->validate();
    }

    public function routeRules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'endpoint with YAML',
                path: '/endpoint/yaml?url'.route('services.endpoint.yaml'),
                data: $this->render([
                    'label' => 'YAML',
                    'message' => 'OK',
                    'messageColor' => 'green.600',
                ]),
            ),
        ];
    }
}
