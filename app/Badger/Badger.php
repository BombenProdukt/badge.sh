<?php

declare(strict_types=1);

namespace App\Badger;

use App\Badger\Contracts\BadgeRenderer;
use App\Badger\Exceptions\InvalidRendererException;

final class Badger
{
    protected array $renderers = [];

    public function __construct(array $renderers)
    {
        foreach ($renderers as $renderer) {
            $this->addRenderFormat($renderer);
        }
    }

    public function generate(string $subject, string $subjectColor, string $message, string $messageColor, string $format)
    {
        $badge = new Badge($subject, $subjectColor, $message, $messageColor, $format);

        return $this->getRendererForFormat($badge->getFormat())->render($badge);
    }

    protected function addRenderFormat(BadgeRenderer $renderer): void
    {
        foreach ($renderer->getSupportedFormats() as $format) {
            $this->renderers[$format] = $renderer;
        }
    }

    protected function getRendererForFormat(string $format)
    {
        if (!isset($this->renderers[$format])) {
            throw new InvalidRendererException('No renders found for the given format: '.$format);
        }

        return $this->renderers[$format];
    }
}
