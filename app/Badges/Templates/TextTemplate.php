<?php

declare(strict_types=1);

namespace App\Badges\Templates;

final class TextTemplate
{
    public static function make(string $label, mixed $message, string $messageColor): array
    {
        return [
            'label'        => $label,
            'message'      => $message,
            'messageColor' => $messageColor,
        ];
    }
}
