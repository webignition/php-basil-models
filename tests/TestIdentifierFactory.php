<?php

namespace webignition\BasilModel\Tests;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueTypes;

class TestIdentifierFactory
{
    public static function createElementIdentifier(
        string $type,
        string $selector,
        int $position,
        ?string $name,
        ?string $attributeName = null,
        ?ElementIdentifierInterface $parentIdentifier = null
    ): ElementIdentifierInterface {
        $value = $type === ValueTypes::CSS_SELECTOR
            ? LiteralValue::createCssSelectorValue($selector)
            : LiteralValue::createXpathExpressionValue($selector);

        $identifier = new ElementIdentifier($value, $position);

        if (null !== $name) {
            $identifier = $identifier->withName($name);
        }

        if (null !== $attributeName && $identifier instanceof ElementIdentifierInterface) {
            $identifier = $identifier->withAttributeName($attributeName);
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
