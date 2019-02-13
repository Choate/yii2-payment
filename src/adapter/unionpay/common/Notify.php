<?php

namespace choate\yii2\payment\adapter\unionpay\common;


use choate\yii2\payment\NotifyInterface;

class Notify implements NotifyInterface
{
    private $orderNo;

    private $paymentNo;

    private $paymentAmount;

    private $currency;

    private $systemSSN;

    private $respCode;

    private $settDate;

    private $reserved01;

    private $reserved02;

    private $signature;

    private $status = false;

    /**
     * @return mixed
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }

    /**
     * @param mixed $orderNo
     */
    public function setOrderNo($orderNo)
    {
        $this->orderNo = $orderNo;
    }

    /**
     * @return mixed
     */
    public function getPaymentNo()
    {
        return $this->paymentNo;
    }

    /**
     * @param mixed $paymentNo
     */
    public function setPaymentNo($paymentNo)
    {
        $this->paymentNo = $paymentNo;
    }

    /**
     * @return mixed
     */
    public function getPaymentAmount()
    {
        return $this->paymentAmount;
    }

    /**
     * @param mixed $paymentAmount
     */
    public function setPaymentAmount($paymentAmount)
    {
        $this->paymentAmount = $paymentAmount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getSystemSSN()
    {
        return $this->systemSSN;
    }

    /**
     * @param mixed $systemSSN
     */
    public function setSystemSSN($systemSSN)
    {
        $this->systemSSN = $systemSSN;
    }

    /**
     * @return mixed
     */
    public function getRespCode()
    {
        return $this->respCode;
    }

    /**
     * @param mixed $respCode
     */
    public function setRespCode($respCode)
    {
        $this->respCode = $respCode;
    }

    /**
     * @return mixed
     */
    public function getSettDate()
    {
        return $this->settDate;
    }

    /**
     * @param mixed $settDate
     */
    public function setSettDate($settDate)
    {
        $this->settDate = $settDate;
    }

    /**
     * @return mixed
     */
    public function getReserved01()
    {
        return $this->reserved01;
    }

    /**
     * @param mixed $reserved01
     */
    public function setReserved01($reserved01)
    {
        $this->reserved01 = $reserved01;
    }

    /**
     * @return mixed
     */
    public function getReserved02()
    {
        return $this->reserved02;
    }

    /**
     * @param mixed $reserved02
     */
    public function setReserved02($reserved02)
    {
        $this->reserved02 = $reserved02;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    public function getResponse()
    {
        if ($this->getIsSuccess()) {
            return 'ERROR';
        } else {
            return 'OK';
        }
    }

    /**
     * @return bool
     */
    public function getIsSuccess() {
        return $this->status && strcmp($this->getRespCode(), '00') === 0;
    }

    public function process(\Closure $callback)
    {
        if ($this->getIsSuccess()) {
            if (call_user_func($callback, $this)) {
                $this->status = true;
            } else {
                $this->status = false;
            }
        }
    }

    public function validateSignature($merchantKey)
    {
        $signatureString = $this->getOrderNo() . $this->getPaymentNo() . $this->getPaymentAmount() . $this->getCurrency() . $this->getSystemSSN() . $this->getRespCode() . $this->getSettDate() . $this->getReserved01() . $this->getReserved02();

        $this->status = strcmp(md5($signatureString . md5($merchantKey)), $this->signature) === 0;

        return $this->status;
    }
}