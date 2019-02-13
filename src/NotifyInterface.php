<?php


namespace choate\yii2\payment;


interface NotifyInterface
{
    /**
     * @return mixed
     */
    public function getResponse();

    /**
     * @return bool
     */
    public function getIsSuccess();
}