<?php

declare(strict_types=1);

namespace App\Badges\Endpoint\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Endpoint\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Yaml;

final class YAMLBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(): array
    {
        return Validator::make(
            Yaml::parse(Http::get($this->getRequestData('url'))->throw()->body()),
            [
                'schemaVersion' => ['required', 'in:1'],
                'label'         => ['required', 'string'],
                'labelColor'    => ['nullable', 'string'],
                'message'       => ['required', 'string'],
                'messageColor'  => ['required', 'string'],
                'style'         => ['nullable', 'string'],
                'icon'          => ['nullable', 'string'],
                'iconWidth'     => ['nullable', 'integer'],
                'scale'         => ['nullable', 'integer'],
            ]
        )->validate();
    }

    public function service(): string
    {
        return 'Endpoint';
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/endpoint/yaml',
        ];
    }

    public function routeRules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/endpoint/yaml?url'.route('services.endpoint.yaml')   => 'endpoint with YAML',
        ];
    }
}
