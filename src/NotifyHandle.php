<?php

namespace choate\yii2\payment;


class NotifyHandle
{
    /**
     * @var \Closure
     */
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    public function notifyProcess(array $data)
    {
        return call_user_func($this->callback, $data);
    }
}