<?php

declare(strict_types=1);

namespace App\Badger;

use App\Badger\Exceptions\InvalidHexColorException;
use Spatie\Regex\Regex;

final class Badge
{
    public function __construct(
        private string $subject,
        private string $subjectColor,
        private string $message,
        private string $messageColor,
        private string $format = 'flat-square',
    ) {
        $this->subject = \htmlspecialchars($subject, \ENT_XML1, 'UTF-8');
        $this->subjectColor = $this->getColorMapOrAsHex($subjectColor);
        $this->message = \htmlspecialchars($message, \ENT_XML1, 'UTF-8');
        $this->messageColor = $this->getColorMapOrAsHex($messageColor);

        if (!$this->isValidHex($this->messageColor)) {
            throw new InvalidHexColorException('The color argument "'.$this->messageColor.'" is invalid.');
        }

        if (!$this->isValidHex($this->subjectColor)) {
            throw new InvalidHexColorException('The color argument "'.$this->subjectColor.'" is invalid.');
        }
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getSubjectColor(): string
    {
        return $this->subjectColor;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMessageColor(): string
    {
        return $this->messageColor;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function toString(): string
    {
        return \sprintf(
            '%s-%s-%s-%s.%s',
            $this->subject,
            $this->subjectColor,
            $this->message,
            $this->messageColor,
            $this->format,
        );
    }

    protected function getColorMapOrAsHex(string $color): string
    {
        return Color::get($color);
    }

    protected function isValidHex(string $color): bool
    {
        return Regex::match('/^[0-9a-fA-F]{3,6}$/', \ltrim($color, '#'))->hasMatch();
    }
}
