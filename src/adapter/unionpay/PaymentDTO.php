<?php


namespace choate\yii2\payment\adapter\unionpay;

use choate\yii2\payment\BaseDTO;

class PaymentDTO extends BaseDTO
{

    /**
     * 语言选项
     *
     * @var string
     */
    private $langType;

    /**
     * 订单类型
     *
     * @var string
     */
    private $orderType;

    /**
     * 支付币种
     *
     * @var string
     */
    private $currency;

    /**
     * 订单号
     *
     * @var string
     */
    private $orderNo;

    /**
     * 订单金额
     *
     * @var double
     */
    private $amount;

    /**
     * 银行直通码
     *
     * @var string
     */
    private $bankCode;

    /**
     * 业务类型
     *
     * @var string
     */
    private $buzType;

    /**
     * 保留字段
     *
     * @var string
     */
    private $reserved01;

    /**
     * 保留字段
     *
     * @var string
     */
    private $reserved02;

    /**
     * @return string
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }

    /**
     * @param string $orderNo
     */
    public function setOrderNo($orderNo)
    {
        $this->orderNo = $orderNo;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getLangType()
    {
        return $this->langType;
    }

    /**
     * @param string $langType
     */
    public function setLangType($langType)
    {
        $this->langType = $langType;
    }


    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }


    /**
     * @return string
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @param string $bankCode
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
    }

    /**
     * @return string
     */
    public function getBuzType()
    {
        return $this->buzType;
    }

    /**
     * @param string $buzType
     */
    public function setBuzType($buzType)
    {
        $this->buzType = $buzType;
    }

    /**
     * @return string
     */
    public function getReserved01()
    {
        return $this->reserved01;
    }

    /**
     * @param string $reserved01
     */
    public function setReserved01($reserved01)
    {
        $this->reserved01 = $reserved01;
    }

    /**
     * @return string
     */
    public function getReserved02()
    {
        return $this->reserved02;
    }

    /**
     * @param string $reserved02
     */
    public function setReserved02($reserved02)
    {
        $this->reserved02 = $reserved02;
    }
    
    
}