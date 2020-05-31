<?php

declare(strict_types=1);

namespace Paydo\Throwable\ValueObject;

use Paydo\ValueObject\Currency;
use Paydo\ValueObject\ValueObjectInterface;

/**
 * Class InvalidProductValue
 *
 * @package Paydo\Throwable\ValueObject
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class InvalidCurrencyValue extends AbstractInvalidValueException
{
    /**
     * @var Currency
     */
    private Currency $currency;

    public function __construct(Currency $product)
    {
        $this->currency = $product;

        parent::__construct($product->getValue());
    }

    /**
     * {@inheritDoc}
     */
    protected function getValueObjectClass(): ValueObjectInterface
    {
        return $this->currency;
    }
}
