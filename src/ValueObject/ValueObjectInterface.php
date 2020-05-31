<?php

declare(strict_types=1);

namespace Paydo\ValueObject;

/**
 * Interface ValueObjectInterface
 *
 * @package Paydo\ValueObject
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
interface ValueObjectInterface
{
    /**
     * @return array
     */
    public static function getValidValues(): array;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function isEquals(ValueObjectInterface $valueObject): bool;
}
