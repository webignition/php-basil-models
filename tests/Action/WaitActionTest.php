<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\WaitAction;
use webignition\BasilModel\Value\EnvironmentValue;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ValueInterface;

class WaitActionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        string $actionString,
        ValueInterface $duration,
        string $expectedArguments
    ) {
        $action = new WaitAction($actionString, $duration);

        $this->assertSame(ActionTypes::WAIT, $action->getType());
        $this->assertSame($expectedArguments, $action->getArguments());
        $this->assertSame($duration, $action->getDuration());
        $this->assertTrue($action->isRecognised());
        $this->assertSame($actionString, $action->getActionString());
    }

    public function createDataProvider(): array
    {
        return [
            'string value' => [
                'actionString' => 'wait 10',
                'duration' => LiteralValue::createStringValue('10'),
                'expectedArguments' => '10',
            ],
            'environment parameter value' => [
                'actionString' => 'wait $env.DURATION',
                'duration' => new EnvironmentValue(
                    '$env.DURATION',
                    'DURATION'
                ),
                'expectedArguments' => '$env.DURATION',
            ],
        ];
    }
}
