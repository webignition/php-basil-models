<?php

namespace webignition\BasilModel\Tests\Unit\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\InteractionAction;
use webignition\BasilModel\Identifier\DomIdentifier;

class InteractionActionTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $type = ActionTypes::CLICK;
        $identifier = new DomIdentifier('.selector');

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
        $this->assertSame('click ".selector"', $action->getSource());
    }

    public function testWithIdentifier()
    {
        $originalIdentifier = new DomIdentifier('.original');
        $newIdentifier = new DomIdentifier('.new');

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
