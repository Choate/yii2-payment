<?php

namespace choate\yii2\payment;


interface AdapterInterface
{
    /**
     * @param $paymentDTO
     * @return PaymentInterface
     */
    public function payment($paymentDTO);

    /**
     * @param $notifyDTO
     * @param \Closure $callback
     * @return NotifyInterface
     */
    public function notify(array $notifyDTO, \Closure $callback);
}