<?php

declare(strict_types=1);

namespace App\Badger;

final class BadgeImage
{
    public function __construct(protected readonly string $content, protected readonly string $format)
    {
        //
    }

    public static function createFromString(string $content, string $format): static
    {
        return new self($content, $format);
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function toString(): string
    {
        return (string) $this->content;
    }
}
