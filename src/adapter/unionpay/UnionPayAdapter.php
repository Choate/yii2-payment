<?php

namespace choate\yii2\payment\adapter\unionpay;


use choate\yii2\payment\adapter\unionpay\common\Notify;
use choate\yii2\payment\adapter\unionpay\common\Payment;
use choate\yii2\payment\AdapterInterface;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class UnionPayAdapter extends Component implements AdapterInterface
{
    /**
     * @var string 商户ID
     */
    public $merchantId;

    /**
     * @var string 商户密钥
     */
    public $merchantKey;

    /**
     * @var string 语言选项
     */
    public $langType;

    /**
     * @var string 回调地址
     */
    public $callbackUrl;

    /**
     * @var string 订单类型
     */
    public $orderType;

    /**
     * @var string 支付币种
     */
    public $currency;

    /**
     * 是否使用沙盒
     *
     * @var bool
     */
    public $useSandbox;

    /**
     * @param PaymentDTO $paymentDTO
     * @return \choate\yii2\payment\PaymentInterface
     */
    public function payment($paymentDTO)
    {
        $payment = new Payment($this->merchantKey, $this->merchantId, $this->useSandbox, $paymentDTO->getOrderNo(), $paymentDTO->getAmount(), $this->callbackUrl);
        $payment->setLangType($this->langType);
        $payment->setCurrency($paymentDTO->getCurrency() ?? $this->currency);
        $payment->setOrderType($paymentDTO->getOrderType() ?? $this->orderType);
        $payment->setBuzType($paymentDTO->getBuzType());
        $payment->setBankCode($paymentDTO->getBankCode());
        $payment->setReserved01($paymentDTO->getReserved01());
        $payment->setReserved02($paymentDTO->getReserved02());

        return $payment;
    }

    public function notify(array $notifyDTO, \Closure $callback)
    {
        $notify = new Notify();
        $notify->setOrderNo(ArrayHelper::getValue($notifyDTO, 'OrderNo'));
        $notify->setPaymentNo(ArrayHelper::getValue($notifyDTO, 'PayNo'));
        $notify->setPaymentAmount(ArrayHelper::getValue($notifyDTO, 'PayAmount'));
        $notify->setCurrency(ArrayHelper::getValue($notifyDTO, 'CurrCode'));
        $notify->setSystemSSN(ArrayHelper::getValue($notifyDTO, 'SystemSSN'));
        $notify->setRespCode(ArrayHelper::getValue($notifyDTO, 'RespCode'));
        $notify->setSettDate(ArrayHelper::getValue($notifyDTO, 'SettDate'));
        $notify->setReserved01(ArrayHelper::getValue($notifyDTO, 'Reserved01'));
        $notify->setReserved02(ArrayHelper::getValue($notifyDTO, 'Reserved02'));
        $notify->setSignature(ArrayHelper::getValue($notifyDTO, 'SignMsg'));
        $notify->validateSignature($this->merchantKey);
        $notify->process($callback);

        return $notify;
    }

}