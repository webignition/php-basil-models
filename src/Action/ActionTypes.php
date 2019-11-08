<?php

namespace webignition\BasilModel\Action;

class ActionTypes
{
    public const CLICK = 'click';
    public const SET = 'set';
    public const SUBMIT = 'submit';
    public const WAIT = 'wait';
    public const WAIT_FOR = 'wait-for';
    public const BACK = 'back';
    public const FORWARD = 'forward';
    public const RELOAD = 'reload';

    public const ALL = [
        self::CLICK,
        self::SET,
        self::SUBMIT,
        self::WAIT,
        self::WAIT_FOR,
        self::BACK,
        self::FORWARD,
        self::RELOAD
    ];
}
