<?php

namespace webignition\BasilModel\Value;

class ObjectValueType
{
    public const BROWSER_PROPERTY = 'browser-property';
    public const DATA_PARAMETER = 'data-parameter';
    public const ENVIRONMENT_PARAMETER = 'environment-parameter';
    public const PAGE_PROPERTY = 'page-property';

    public const ACTIONABLE = [
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];

    public const EXAMINABLE = [
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];

    public const EXPECTABLE = [
        self::BROWSER_PROPERTY,
        self::DATA_PARAMETER,
        self::ENVIRONMENT_PARAMETER,
        self::PAGE_PROPERTY,
    ];
}
