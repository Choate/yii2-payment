<?php


namespace choate\yii2\payment;

use \ReflectionClass;

abstract class BaseDTO
{
    public static function load($data)
    {
        $class = new static();
        $class->setAttributes($data);

        return $class;
    }

    /**
     * @param array $values
     * @throws \ReflectionException
     */
    protected function setAttributes($values)
    {
        if (is_array($values)) {
            $attributes = $this->attributes();
            foreach ($values as $name => $value) {
                if (isset($attributes[$name])) {
                    $this->$name = $value;
                }
            }
        }
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    protected function attributes()
    {
        $class = new ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $names[] = $property->getName();
            }
        }

        return $names;
    }
}