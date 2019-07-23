<?php

namespace webignition\BasilModel\Tests\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InteractionAction;
use webignition\BasilModel\Identifier\Identifier;
use webignition\BasilModel\Identifier\IdentifierTypes;

class InteractionActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $type = ActionTypes::CLICK;
        $identifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            '.selector'
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
        $originalIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            '.original'
        );

        $newIdentifier = new Identifier(
            IdentifierTypes::CSS_SELECTOR,
            '.new'
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
