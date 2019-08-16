<?php

namespace webignition\BasilModel\Tests\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InputAction;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\LiteralValue;

class InputActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.selector'));
        $value = LiteralValue::createCssSelectorValue('.foo');

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
        $originalIdentifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.original'));

        $newIdentifier = new ElementIdentifier(LiteralValue::createCssSelectorValue('.new'));

        $action = new InputAction(
            'set ".original" to "value"',
            $originalIdentifier,
            LiteralValue::createStringValue('value'),
            '".original" to "value"'
        );

        $mutatedAction = $action->withIdentifier($newIdentifier);

        $this->assertNotSame($action, $mutatedAction);
        $this->assertSame($originalIdentifier, $action->getIdentifier());
        $this->assertSame($newIdentifier, $mutatedAction->getIdentifier());
    }

    public function testWithValueReturnsSameInstance()
    {
        $originalValue = LiteralValue::createStringValue('original-value');

        $action = new InputAction(
            'set ".selector" to "original-value"',
            new ElementIdentifier(
                LiteralValue::createCssSelectorValue('.selector')
            ),
            $originalValue,
            '".selector" to "original-value"'
        );

        $newAction = $action->withValue($originalValue);

        $this->assertSame($newAction, $action);
    }

    public function testWithValueReturnsNewInstance()
    {
        $actionString = 'set ".selector" to "original-value';
        $identifier = new ElementIdentifier(
            LiteralValue::createCssSelectorValue('.selector')
        );

        $originalValue = LiteralValue::createStringValue('original-value');
        $newValue = LiteralValue::createStringValue('new-value');
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
