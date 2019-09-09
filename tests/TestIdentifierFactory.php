<?php

namespace webignition\BasilModel\Tests;

use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifierInterface;
use webignition\BasilModel\Value\CssSelector;
use webignition\BasilModel\Value\ValueTypes;
use webignition\BasilModel\Value\XpathExpression;

class TestIdentifierFactory
{
    public static function createElementIdentifier(
        string $type,
        string $selector,
        ?int $position,
        ?string $name,
        ?ElementIdentifierInterface $parentIdentifier = null
    ): ElementIdentifierInterface {
        $value = $type === ValueTypes::CSS_SELECTOR
            ? new CssSelector($selector)
            : new XpathExpression($selector);

        $identifier = new ElementIdentifier($value, $position);

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
