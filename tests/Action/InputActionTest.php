<?php

namespace webignition\BasilModel\Tests\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InputAction;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\LiteralValue;

class InputActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            '.selector'
        );
        $value = new LiteralValue('.foo');

        $action = new InputAction(
            'set ".selector" to "foo"',
            $identifier,
            $value,
            '".selector" to "foo"'
        );

        $this->assertSame(ActionTypes::SET, $action->getType());
        $this->assertSame('".selector" to "foo"', $action->getArguments());
        $this->assertSame($identifier, $action->getIdentifier());
        $this->assertSame($value, $action->getValue());
        $this->assertTrue($action->isRecognised());
        $this->assertSame('set ".selector" to "foo"', $action->getActionString());
    }

    public function testWithIdentifier()
    {
        $originalIdentifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            '.original'
        );

        $newIdentifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            '.new'
        );

        $action = new InputAction(
            'set ".original" to "value"',
            $originalIdentifier,
            new LiteralValue('value'),
            '".original" to "value"'
        );

        $mutatedAction = $action->withIdentifier($newIdentifier);

        $this->assertNotSame($action, $mutatedAction);
        $this->assertSame($originalIdentifier, $action->getIdentifier());
        $this->assertSame($newIdentifier, $mutatedAction->getIdentifier());
    }
}
