<?php

declare(strict_types=1);

namespace App\Integrations\LGTM\Controllers;

use App\Integrations\LGTM\Client;
use Illuminate\Routing\Controller;

final class GradeController extends Controller
{
    private array $languages = [
        'cpp'        => 'c/c++',
        'csharp'     => 'c#',
        'javascript' => 'js/ts',
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $provider, string $owner, string $name, ?string $language = null): array
    {
        $response = $this->client->get($provider, $owner, $name, $language);

        return [
            'label'       => 'code quality: '.($this->languages[$response['lines']] ?? $language),
            'status'      => $response['grade'],
            'statusColor' => [
                'A+' => 'green.600',
                'A'  => '9C0',
                'B'  => 'A4A61D',
                'C'  => 'yellow.600',
                'D'  => 'orange.600',
            ][$response['grade']],
        ];
    }
}