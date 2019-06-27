<?php

declare(strict_types = 1);

namespace Cheppers\OtpClient\DataType;

class Base
{

    /**
     * @var string[]
     */
    protected static $propertyMapping = [
        'ORDER_DATE' => 'orderDate',
        'REFNO' => 'refNo',
        'REFNOEXT' => 'refNoExt',
        'ORDER_STATUS' => 'orderStatus',
        'PAYMETHOD' => 'payMethod',
    ];

    public static function __set_state($values)
    {
        $self = new static();
        foreach (static::$propertyMapping as $src => $dst) {
            if (!array_key_exists($src, $values) || !property_exists($self, $dst)) {
                continue;
            }

            $self->{$dst} = $values[$src];
        }

        return $self;
    }

}