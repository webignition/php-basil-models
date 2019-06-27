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
        $identifier = new Identifier(IdentifierTypes::CSS_SELECTOR, '.foo');

        $action = new InteractionAction($type, $identifier, '".foo"');

        $this->assertSame($type, $action->getType());
        $this->assertSame('".foo"', $action->getArguments());
        $this->assertSame($identifier, $action->getIdentifier());
        $this->assertTrue($action->isRecognised());
    }
}
