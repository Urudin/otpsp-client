<?php

declare(strict_types = 1);

namespace Cheppers\OtpspClient\DataType;

abstract class RedirectBase
{

    /**
     * @var string[]
     */
    protected static $propertyMapping = [];

    public static function __set_state($values)
    {
        $instance = new static();
        foreach (array_keys(static::$propertyMapping) as $internal) {
            if (!array_key_exists($internal, $values) || !property_exists($instance, $internal)) {
                continue;
            }

            $instance->{$internal} = $values[$internal];
        }

        return $instance;
    }

    abstract public function isEmpty(): bool;

    /**
     * Internal name of the required fields.
     *
     * @var string[]
     */
    protected $requiredFields = [];

    public function exportData(): array
    {
        if ($this->isEmpty()) {
            return [];
        }

        $data = [];
        foreach (static::$propertyMapping as $internal => $external) {
            $value =  $this->{$internal};
            if (!in_array($internal, $this->requiredFields) && !$value) {
                continue;
            }

            $data[] = [
                $external => $value,
            ];
        }

        return $data;
    }
}
