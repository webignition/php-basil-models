<?php

namespace webignition\BasilModel\Value;

class ObjectValueType
{
    const BROWSER_PROPERTY = 'browser-property';
    const DATA_PARAMETER = 'data-parameter';
    const ENVIRONMENT_PARAMETER = 'environment-parameter';
    const PAGE_PROPERTY = 'page-property';

    const ACTIONABLE = [
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];

    const EXAMINABLE = [
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];

    const EXPECTABLE = [
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];
}
