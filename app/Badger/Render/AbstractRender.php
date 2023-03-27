<?php

declare(strict_types=1);

namespace App\Badger\Render;

use App\Badger\Badge;
use App\Badger\BadgeImage;
use App\Badger\Calculator\TextSizeCalculatorInterface;

abstract class AbstractRender implements RenderInterface
{
    // TEMPORARY
    private ?string $icon = null;

    // TEMPORARY
    private int $iconWidth = 13;

    // TEMPORARY
    private int $scale = 1;

    public function __construct(private readonly TextSizeCalculatorInterface $calculator)
    {
        //
    }

    public function render(Badge $badge): BadgeImage
    {
        $messageColor = $badge->getMessageColor();
        $subjectColor = $badge->getSubjectColor();
        $iconWidth = $this->iconWidth * 10;

        $iconSpanWidth = $this->icon ? (\mb_strlen($badge->getSubject()) ? $iconWidth + 30 : $iconWidth - 18) : 0;
        $sbTextStart = $this->icon ? ($iconSpanWidth + 50) : 50;
        $sbTextWidth = $badge->getSubject() ? $this->stringWidth($badge->getSubject()) : 0;
        $stTextWidth = $this->stringWidth($badge->getMessage());
        $sbRectWidth = $sbTextWidth + 100 + $iconSpanWidth;
        $stRectWidth = $stTextWidth + 100;
        $width = $sbRectWidth + $stRectWidth;
        $xlink = $this->icon ? ' xmlns:xlink="http://www.w3.org/1999/xlink"' : '';

        $subject = $badge->getSubject() ?: '';
        $message = $badge->getMessage();
        $messageColor = $messageColor;
        $subjectColor = $subjectColor;
        $icon = $this->icon;
        $accessibleText = \is_string($subject) ? "{$subject}: {$message}" : $message;

        return $this->renderSvg([
            'accessibleText' => $accessibleText,
            'icon' => $icon,
            'iconSpanWidth' => $iconSpanWidth,
            'iconWidth' => $iconWidth,
            'message' => $message,
            'messageColor' => $messageColor,
            'sbRectWidth' => $sbRectWidth,
            'sbTextStart' => $sbTextStart,
            'sbTextWidth' => $sbTextWidth,
            'scale' => 1,
            'stRectWidth' => $stRectWidth,
            'stTextWidth' => $stTextWidth,
            'subject' => $subject,
            'subjectColor' => $subjectColor,
            'width' => $width,
            'xlink' => $xlink,
        ], $badge->getFormat());
    }

    protected function stringWidth($text): float
    {
        return $this->calculator->calculateWidth($text);
    }

    protected function renderSvg(array $params, string $format): BadgeImage
    {
        return BadgeImage::createFromString(view("badger.{$format}", $params)->render(), $format);
    }
}
