<?php

namespace webignition\BasilModel\Tests;

use webignition\BasilModel\Identifier\DomIdentifier;
use webignition\BasilModel\Identifier\DomIdentifierInterface;

class TestIdentifierFactory
{
    public static function createObjectIdentifier(
        string $elementLocator,
        ?int $position,
        ?string $name = '',
        ?DomIdentifierInterface $parentIdentifier = null
    ): DomIdentifierInterface {
        $identifier = new DomIdentifier($elementLocator);

        if (null !== $position) {
            $identifier = $identifier->withPosition($position);
        }

        if (null !== $name) {
            $identifier = $identifier->withName($name);
        }

        if ($identifier instanceof DomIdentifierInterface &&
            $parentIdentifier instanceof DomIdentifierInterface) {
            $identifier = $identifier->withParentIdentifier($parentIdentifier);
        }

        if ($identifier instanceof DomIdentifierInterface) {
            return $identifier;
        }

        throw new \RuntimeException('Identifier is not an ElementIdentifierInterface instance');
    }
}
