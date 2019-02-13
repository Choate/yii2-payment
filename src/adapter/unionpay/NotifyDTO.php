<?php

namespace choate\yii2\payment\adapter\unionpay;



use choate\yii2\payment\BaseDTO;

class NotifyDTO extends BaseDTO
{
    private $orderNo;

    private $paymentNo;

    private $paymentAmount;

    private $currency;

    private $systemSSN;

    private $status;

    private $settDate;

    private $reserved01;

    private $reserved02;

    private $signature;

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
    public function setOrderNo($orderNo): void
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
    public function setPaymentNo($paymentNo): void
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
    public function setPaymentAmount($paymentAmount): void
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
    public function setCurrency($currency): void
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
    public function setSystemSSN($systemSSN): void
    {
        $this->systemSSN = $systemSSN;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
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
    public function setSettDate($settDate): void
    {
        $this->settDate = $settDate;
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
    public function setSignature($signature): void
    {
        $this->signature = $signature;
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
}