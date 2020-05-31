<?php

declare(strict_types=1);

namespace Paydo\ValueObject;

use Enuage\Type\PseudoEnum;
use Paydo\Throwable\ValueObject\InvalidCurrencyValue;

/**
 * Class Currency
 *
 * @package Paydo\ValueObject
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class Currency extends AbstractValueObject implements ValueObjectInterface
{
    /**
     * {@inheritDoc}
     */
    protected function validate()
    {
        $validValues = new PseudoEnum(static::getValidValues());

        if (false === $validValues->containsValue($this->getValue())) {
            throw new InvalidCurrencyValue($this);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function getValidValues(): array
    {
        return [
            'EUR',
            'GBP',
            'USD',
        ];
    }
}
