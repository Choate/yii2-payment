<?php

namespace choate\yii2\payment\adapter\unionpay\common;


use choate\yii2\payment\PaymentInterface;

class Payment implements PaymentInterface
{
    /**
     * 商户ID
     *
     * @var string
     */
    private $merchantId;

    /**
     * 语言选项
     *
     * @var string
     */
    private $langType;

    /**
     * 回调地址
     *
     * @var string
     */
    private $callbackUrl;

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
     * 签名
     *
     * @var string
     */
    private $signature;

    private $merchantKey;

    private $useSandbox = false;

    public function __construct($merchantKey, $merchantId, $useSandbox, $orderNo, $amount, $callbackUrl)
    {
        $this->merchantId = $merchantId;
        $this->orderNo = $orderNo;
        $this->amount = $amount;
        $this->callbackUrl = $callbackUrl;
        $this->merchantKey = $merchantKey;
        $this->useSandbox = $useSandbox;
    }

    /**
     * @return string
     */
    public function getPaymentRequest()
    {
        $this->generateSignature();
        $content = sprintf('<form method="POST" action="%s">', $this->getServerUrl());
        foreach ($this->mapField() as $field => $name) {
            $value = $this->{$field};

            $content .= sprintf('<input type="hidden" name="%s" value="%s" />', $name, $value);
        }

        $content .= '</form>';

        return $content;
    }

    /**
     * 生成签名
     */
    protected function generateSignature()
    {
        $map = $this->mapField();
        unset($map['signature']);
        $signatureString = '';
        foreach ($map as $field => $name) {
            $signatureString .= $this->{$field};
        }

        $this->signature = md5($signatureString . md5($this->merchantKey));
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
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
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
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
    public function getOrderNo()
    {
        return $this->orderNo;
    }


    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
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

    protected function mapField()
    {
        return [
            'merchantId' => 'MerId',
            'orderNo' => 'OrderNo',
            'amount' => 'OrderAmount',
            'currency' => 'CurrCode',
            'orderType' => 'OrderType',
            'callbackUrl' => 'CallBackUrl',
            'bankCode' => 'BankCode',
            'langType' => 'LangType',
            'buzType' => 'BuzType',
            'reserved01' => 'Reserved01',
            'reserved02' => 'Reserved02',
            'signature' => 'SignMsg',
        ];
    }

    protected function getServerUrl()
    {
        return $this->useSandbox ? 'http://test.gnetpg.com:8089/GneteMerchantAPI/api/PayV36' : 'https://www.gnetpg.com/GneteMerchantAPI/api/PayV36';
    }
}