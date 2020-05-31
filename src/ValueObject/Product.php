<?php

declare(strict_types=1);

namespace Paydo\ValueObject;

use Enuage\Type\PseudoEnum;
use Paydo\Throwable\ValueObject\InvalidProductValue;

/**
 * Class Product
 *
 * @package Paydo\ValueObject
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class Product extends AbstractValueObject implements ValueObjectInterface
{
    /**
     * {@inheritDoc}
     */
    protected function validate()
    {
        $validValues = new PseudoEnum(static::getValidValues());

        if (false === $validValues->containsValue($this->getValue())) {
            throw new InvalidProductValue($this);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function getValidValues(): array
    {
        return [
            'ECOM',
            'POS',
        ];
    }
}
