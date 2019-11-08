<?php

namespace webignition\BasilModel\Tests;

use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Identifier\DomIdentifierInterface;

class TestIdentifierFactory
{
    public static function createObjectIdentifier(
        string $elementLocator,
        ?int $ordinalPosition,
        ?string $name = '',
        ?DomIdentifierInterface $parentIdentifier = null
    ): DomIdentifierInterface {
        $identifier = new DomIdentifier($elementLocator, $ordinalPosition);

        if (null !== $name) {
            $identifier = $identifier->withName($name);
        }

        if (
            $identifier instanceof DomIdentifierInterface &&
            $parentIdentifier instanceof DomIdentifierInterface
        ) {
            $identifier = $identifier->withParentIdentifier($parentIdentifier);
        }

        if ($identifier instanceof DomIdentifierInterface) {
            return $identifier;
        }

        throw new \RuntimeException('Identifier is not an ElementIdentifierInterface instance');
    }
}
