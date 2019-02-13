<?php

namespace choate\yii2\payment;

use yii\base\Component;
use yii\base\InvalidArgumentException;
use yii\di\Instance;

class Collection extends Component
{
    public $adapterCollectionItems = [];

    /**
     * @param $adapter
     * @return AdapterInterface
     * @throws \yii\base\InvalidConfigException
     */
    public function getAdapter($adapter)
    {
        if (!array_key_exists($adapter, $this->adapterCollectionItems)) {
            throw new InvalidArgumentException("Unknown adapter '{$adapter}'.");
        }
        if (!is_object($this->adapterCollectionItems[$adapter])) {
            $this->adapterCollectionItems[$adapter] = $this->createAdapter($this->adapterCollectionItems[$adapter]);
        }

        return $this->adapterCollectionItems[$adapter];
    }

    /**
     * @param $config
     * @return object|AdapterInterface
     * @throws \yii\base\InvalidConfigException
     */
    protected function createAdapter($config)
    {
        return Instance::ensure($config, AdapterInterface::class);
    }
}