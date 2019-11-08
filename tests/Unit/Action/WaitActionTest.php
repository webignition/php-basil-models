<?php

/** @noinspection PhpDocSignatureInspection */

declare(strict_types=1);

namespace webignition\BasilModel\Tests\Unit\Action;

use webignition\BasilModel\Action\ActionTypes;
use webignition\BasilModel\Action\WaitAction;
use webignition\BasilModel\Value\LiteralValue;
use webignition\BasilModel\Value\ObjectValue;
use webignition\BasilModel\Value\ObjectValueType;
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
        $this->assertSame($actionString, $action->getSource());
    }

    public function createDataProvider(): array
    {
        return [
            'string value' => [
                'actionString' => 'wait 10',
                'duration' => new LiteralValue('10'),
                'expectedArguments' => '10',
            ],
            'environment parameter value' => [
                'actionString' => 'wait $env.DURATION',
                'duration' => new ObjectValue(
                    ObjectValueType::ENVIRONMENT_PARAMETER,
                    '$env.DURATION',
                    'DURATION'
                ),
                'expectedArguments' => '$env.DURATION',
            ],
        ];
    }
}
