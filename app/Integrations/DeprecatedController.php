<?php

declare(strict_types=1);

namespace App\Integrations;

final class DeprecatedController extends AbstractController
{
    protected function handleRequest(...$parameters): array
    {
        return [
            'label'       => request()->segment(1),
            'status'      => 'deprecated',
            'statusColor' => 'red.600',
        ];
    }
}
