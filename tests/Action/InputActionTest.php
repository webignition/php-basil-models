<?php

namespace webignition\BasilModel\Tests\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InputAction;
use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\Value;
use webignition\BasilModel\Value\ValueTypes;

class InputActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $identifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(ValueTypes::STRING, '.foo')
        );
        $value = new Value(ValueTypes::STRING, 'foo');

        $action = new InputAction(
            'set ".foo" to "foo"',
            $identifier,
            $value,
            '".foo" to "foo"'
        );

        $this->assertSame(ActionTypes::SET, $action->getType());
        $this->assertSame('".foo" to "foo"', $action->getArguments());
        $this->assertSame($identifier, $action->getIdentifier());
        $this->assertSame($value, $action->getValue());
        $this->assertTrue($action->isRecognised());
    }

    public function testWithIdentifier()
    {
        $originalIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(
                ValueTypes::STRING,
                '.original'
            )
        );

        $newIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            new Value(
                ValueTypes::STRING,
                '.new'
            )
        );

        $action = new InputAction(
            'set ".original" to "value"',
            $originalIdentifier,
            new Value(
                ValueTypes::STRING,
                'value'
            ),
            '".original" to "value"'
        );

        $mutatedAction = $action->withIdentifier($newIdentifier);

        $this->assertNotSame($action, $mutatedAction);
        $this->assertSame($originalIdentifier, $action->getIdentifier());
        $this->assertSame($newIdentifier, $mutatedAction->getIdentifier());
    }
}
