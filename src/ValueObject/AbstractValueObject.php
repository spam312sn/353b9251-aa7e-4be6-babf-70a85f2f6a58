<?php

declare(strict_types=1);

namespace Paydo\ValueObject;

use Exception;
use Paydo\Throwable\ValueObject\AbstractInvalidValueException;

/**
 * Class AbstractValueObject
 *
 * @package Paydo\ValueObject
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
abstract class AbstractValueObject implements ValueObjectInterface
{
    /**
     * @var string
     */
    private string $value;

    /**
     * Product constructor.
     *
     * @param string $value
     *
     * @throws Exception
     */
    public function __construct(string $value)
    {
        $this->value = $value;

        $this->validate();
    }

    /**
     * @return mixed
     *
     * @throws AbstractInvalidValueException
     * @throws Exception
     */
    abstract protected function validate();

    /**
     * {@inheritDoc}
     */
    public function isEquals(ValueObjectInterface $valueObject): bool
    {
        return 0 === strcmp($this->getValue(), $valueObject->getValue());
    }

    /**
     * {@inheritDoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
