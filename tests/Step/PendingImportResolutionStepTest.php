<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\BasilModel\Tests\Step;

use webignition\BasilModel\Action\WaitAction;
use webignition\BasilModel\Assertion\Assertion;
use webignition\BasilModel\Assertion\AssertionComparisons;
use webignition\BasilModel\Identifier\ElementIdentifier;
use webignition\BasilModel\Identifier\IdentifierTypes;
use webignition\BasilModel\Step\PendingImportResolutionStep;
use webignition\BasilModel\Step\PendingImportResolutionStepInterface;
use webignition\BasilModel\Step\Step;
use webignition\BasilModel\Step\StepInterface;
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
                        new WaitAction('wait 30', LiteralValue::createStringValue('30')),
                    ],
                    [
                        new Assertion(
                            '".selector" exists',
                            new ElementValue(new ElementIdentifier(
                                IdentifierTypes::CSS_SELECTOR,
                                '.selector'
                            )),
                            AssertionComparisons::EXISTS
                        ),
                    ]
                ),
                'importName' => '',
                'dataProviderImportName' => '',
                'expectedStep' => new PendingImportResolutionStep(
                    new Step(
                        [
                            new WaitAction('wait 30', LiteralValue::createStringValue('30')),
                        ],
                        [
                            new Assertion(
                                '".selector" exists',
                                new ElementValue(new ElementIdentifier(
                                    IdentifierTypes::CSS_SELECTOR,
                                    '.selector'
                                )),
                                AssertionComparisons::EXISTS
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
}
