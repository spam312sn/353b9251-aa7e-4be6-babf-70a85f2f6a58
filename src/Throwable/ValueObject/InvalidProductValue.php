<?php

declare(strict_types=1);

namespace Paydo\Throwable\ValueObject;

use Paydo\ValueObject\Product;
use Paydo\ValueObject\ValueObjectInterface;

/**
 * Class InvalidProductValue
 *
 * @package Paydo\Throwable\ValueObject
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class InvalidProductValue extends AbstractInvalidValueException
{
    /**
     * @var Product|ValueObjectInterface
     */
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;

        parent::__construct($product->getValue());
    }

    /**
     * {@inheritDoc}
     */
    protected function getValueObjectClass(): ValueObjectInterface
    {
        return $this->product;
    }
}
