<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use App\Actions\DetermineLicense;

final class LicenseTemplate
{
    public static function make(mixed $license): array
    {
        return [
            'label'       => 'license',
            'status'      => DetermineLicense::execute($license),
            'statusColor' => 'blue.600',
        ];
    }
}
