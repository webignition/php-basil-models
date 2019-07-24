<?php

namespace webignition\BasilModel\Tests\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InteractionAction;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Value\LiteralValue;

class InteractionActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $type = ActionTypes::CLICK;
        $identifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.selector')
        );

        $action = new InteractionAction(
            'click ".selector"',
            $type,
            $identifier,
            '".selector"'
        );

        $this->assertSame($type, $action->getType());
        $this->assertSame('".selector"', $action->getArguments());
        $this->assertSame($identifier, $action->getIdentifier());
        $this->assertTrue($action->isRecognised());
        $this->assertSame('click ".selector"', $action->getActionString());
    }

    public function testWithIdentifier()
    {
        $originalIdentifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.original')
        );

        $newIdentifier = new ElementIdentifier(
            IdentifierTypes::CSS_SELECTOR,
            LiteralValue::createCssSelectorValue('.new')
        );

        $action = new InteractionAction(
            'click ".original"',
            ActionTypes::CLICK,
            $originalIdentifier,
            '".original"'
        );

        $mutatedAction = $action->withIdentifier($newIdentifier);

        $this->assertNotSame($action, $mutatedAction);
        $this->assertSame($originalIdentifier, $action->getIdentifier());
        $this->assertSame($newIdentifier, $mutatedAction->getIdentifier());
    }
}
