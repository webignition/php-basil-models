<?php

namespace webignition\BasilModel\Tests\Unit\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InputAction;
use webignition\BasilModel\Identifier\ActionIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\LiteralValue;

class InputActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new ActionIdentifier(
            new ElementIdentifier(
                new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
            )
        );
        $value = new LiteralValue('foo');

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
        $originalIdentifier = new ActionIdentifier(
            new ElementIdentifier(
                new ElementExpression('.original', ElementExpressionType::CSS_SELECTOR)
            )
        );

        $newIdentifier = new ActionIdentifier(
            new ElementIdentifier(new ElementExpression('.new', ElementExpressionType::CSS_SELECTOR))
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

    public function testWithValue()
    {
        $actionString = 'set ".selector" to "original-value';
        $identifier = new ActionIdentifier(
            new ElementIdentifier(
                new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
            )
        );

        $originalValue = new LiteralValue('original-value');
        $newValue = new LiteralValue('new-value');
        $arguments = '".selector" to "original-value"';

        $action = new InputAction($actionString, $identifier, $originalValue, $arguments);
        $newAction = $action->withValue($newValue);

        $this->assertNotSame($action, $newAction);
        $this->assertEquals($identifier, $action->getIdentifier());
        $this->assertEquals($identifier, $newAction->getIdentifier());
        $this->assertEquals($actionString, $action->getActionString());
        $this->assertEquals($actionString, $newAction->getActionString());
        $this->assertEquals($originalValue, $action->getValue());
        $this->assertEquals($newValue, $newAction->getValue());
    }
}
