<?php

namespace webignition\BasilModel\Tests\Unit\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InteractionAction;
use webignition\BasilModel\Identifier\ActionIdentifier;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;

class InteractionActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $type = ActionTypes::CLICK;
        $identifier = new ActionIdentifier(
            new ElementIdentifier(
                new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
            )
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
        $originalIdentifier = new ActionIdentifier(
            new ElementIdentifier(
                new ElementExpression('.original', ElementExpressionType::CSS_SELECTOR)
            )
        );

        $newIdentifier = new ActionIdentifier(
            new ElementIdentifier(new ElementExpression('.new', ElementExpressionType::CSS_SELECTOR))
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
