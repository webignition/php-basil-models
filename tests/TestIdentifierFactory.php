<?php

namespace webignition\BasilModel\Tests;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Value\ElementExpressionInterface;

class TestIdentifierFactory
{
    public static function createElementIdentifier(
        ElementExpressionInterface $elementExpression,
        ?int $position,
        ?string $name,
        ?ElementIdentifierInterface $parentIdentifier = null
    ): ElementIdentifierInterface {
        $identifier = new ElementIdentifier($elementExpression, $position);

        if (null !== $name) {
            $identifier = $identifier->withName($name);
        }

        if ($identifier instanceof ElementIdentifierInterface &&
            $parentIdentifier instanceof ElementIdentifierInterface) {
            $identifier = $identifier->withParentIdentifier($parentIdentifier);
        }

        if ($identifier instanceof ElementIdentifierInterface) {
            return $identifier;
        }

        throw new \RuntimeException('Identifier is not an ElementIdentifierInterface instance');
    }
}
