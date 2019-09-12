<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Unit\Step;

use webignition\BasilModel\Action\WaitAction;
use webignition\BasilModel\Assertion\AssertionComparison;
use webignition\BasilModel\Assertion\ExaminationAssertion;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Step\PendingImportResolutionStep;
use webignition\BasilModel\Step\PendingImportResolutionStepInterface;
use webignition\BasilModel\Step\Step;
use webignition\BasilModel\Step\StepInterface;
use webignition\BasilModel\Value\Assertion\ExaminedValue;
use webignition\BasilModel\Value\ElementExpression;
use webignition\BasilModel\Value\ElementExpressionType;
use webignition\BasilModel\Value\ElementValue;
use webignition\BasilModel\Value\LiteralValue;

class PendingImportResolutionStepTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider createDataProvider
     */
    public function testCreate(
        StepInterface $encapsulatedStep,
        string $importName,
        string $dataProviderImportName,
        PendingImportResolutionStepInterface $expectedStep,
        bool $expectedRequiresResolution
    ) {
        $step = new PendingImportResolutionStep($encapsulatedStep, $importName, $dataProviderImportName);

        $this->assertEquals($expectedStep, $step);
        $this->assertEquals($expectedRequiresResolution, $step->requiresResolution());
        $this->assertSame($encapsulatedStep, $step->getStep());
    }

    public function createDataProvider(): array
    {
        return [
            'empty' => [
                'encapsulatedStep' => new Step([], []),
                'importName' => '',
                'dataProviderImportName' => '',
                'expectedStep' => new PendingImportResolutionStep(new Step([], []), '', ''),
                'expectedRequiresResolution' => false,
            ],
            'import name only' => [
                'encapsulatedStep' => new Step([], []),
                'importName' => 'import_name',
                'dataProviderImportName' => '',
                'expectedStep' => new PendingImportResolutionStep(new Step([], []), 'import_name', ''),
                'expectedRequiresResolution' => true,
            ],
            'data provider import name only' => [
                'encapsulatedStep' => new Step([], []),
                'importName' => '',
                'dataProviderImportName' => 'data_provider_import_name',
                'expectedStep' => new PendingImportResolutionStep(new Step([], []), '', 'data_provider_import_name'),
                'expectedRequiresResolution' => true,
            ],
            'import name and data provider import name' => [
                'encapsulatedStep' => new Step([], []),
                'importName' => 'import_name',
                'dataProviderImportName' => 'data_provider_import_name',
                'expectedStep' => new PendingImportResolutionStep(
                    new Step([], []),
                    'import_name',
                    'data_provider_import_name'
                ),
                'expectedRequiresResolution' => true,
            ],
            'with actions and assertions' => [
                'encapsulatedStep' => new Step(
                    [
                        new WaitAction('wait 30', new LiteralValue('30')),
                    ],
                    [
                        new ExaminationAssertion(
                            '".selector" exists',
                            new ExaminedValue(
                                new ElementValue(new ElementIdentifier(
                                    new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                                ))
                            ),
                            AssertionComparison::EXISTS
                        ),
                    ]
                ),
                'importName' => '',
                'dataProviderImportName' => '',
                'expectedStep' => new PendingImportResolutionStep(
                    new Step(
                        [
                            new WaitAction('wait 30', new LiteralValue('30')),
                        ],
                        [
                            new ExaminationAssertion(
                                '".selector" exists',
                                new ExaminedValue(
                                    new ElementValue(new ElementIdentifier(
                                        new ElementExpression('.selector', ElementExpressionType::CSS_SELECTOR)
                                    ))
                                ),
                                AssertionComparison::EXISTS
                            ),
                        ]
                    ),
                    '',
                    ''
                ),
                'expectedRequiresResolution' => false,
            ],
        ];
    }

    /**
     * @dataProvider clearImportNameDataProvider
     */
    public function testClearImportName(PendingImportResolutionStepInterface $step)
    {
        $newStep = $step->clearImportName();

        $this->assertNotSame($newStep, $step);
        $this->assertSame('', $newStep->getImportName());
    }

    public function clearImportNameDataProvider(): array
    {
        return [
            'no import name' => [
                'step' => new PendingImportResolutionStep(new Step([], []), '', ''),
            ],
            'has import name' => [
                'step' => new PendingImportResolutionStep(new Step([], []), 'step_import_name', ''),
            ],
        ];
    }

    /**
     * @dataProvider clearDataProviderImportNameDataProvider
     */
    public function testClearDataProviderImportName(PendingImportResolutionStepInterface $step)
    {
        $newStep = $step->clearDataProviderImportName();

        $this->assertNotSame($newStep, $step);
        $this->assertSame('', $newStep->getDataProviderImportName());
    }

    public function clearDataProviderImportNameDataProvider(): array
    {
        return [
            'no data provider name' => [
                'step' => new PendingImportResolutionStep(new Step([], []), '', ''),
            ],
            'has data provider name' => [
                'step' => new PendingImportResolutionStep(new Step([], []), '', 'data_provider_import_name'),
            ],
        ];
    }
}
