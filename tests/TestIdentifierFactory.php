<?php

namespace webignition\BasilModel\Tests;

use webignition\BasilModel\Identifier\PageObjectIdentifier;
use webignition\BasilModel\Identifier\PageObjectIdentifierInterface;
use webignition\BasilModel\Value\ElementExpressionInterface;

class TestIdentifierFactory
{
    public static function createObjectIdentifier(
        ElementExpressionInterface $elementExpression,
        ?int $position,
        ?string $name = '',
        ?PageObjectIdentifierInterface $parentIdentifier = null
    ): PageObjectIdentifierInterface {
        $identifier = new PageObjectIdentifier($elementExpression);

        if (null !== $position) {
            $identifier = $identifier->withPosition($position);
        }

        if (null !== $name) {
            $identifier = $identifier->withName($name);
        }

        if ($identifier instanceof PageObjectIdentifierInterface &&
            $parentIdentifier instanceof PageObjectIdentifierInterface) {
            $identifier = $identifier->withParentIdentifier($parentIdentifier);
        }

        if ($identifier instanceof PageObjectIdentifierInterface) {
            return $identifier;
        }

        throw new \RuntimeException('Identifier is not an ElementIdentifierInterface instance');
    }
}
