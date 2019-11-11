<?php

declare(strict_types=1);

namespace webignition\BasilModel\Value;

use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Identifier\DomIdentifierInterface;

class DomIdentifierValue implements DomIdentifierValueInterface
{
    private $identifier;

    public function __construct(DomIdentifierInterface $identifier)
    {
        $this->identifier = $identifier;
    }

    public static function create(string $locator, ?int $ordinalPosition = null): DomIdentifierValue
    {
        return new DomIdentifierValue(
            new DomIdentifier($locator, $ordinalPosition)
        );
    }

    public function getIdentifier(): DomIdentifierInterface
    {
        return $this->identifier;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function isActionable(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return $this->identifier->__toString();
    }
}
