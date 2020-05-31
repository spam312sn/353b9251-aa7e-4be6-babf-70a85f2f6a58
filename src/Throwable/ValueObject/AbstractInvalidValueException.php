<?php


declare(strict_types=1);

namespace Paydo\Throwable\ValueObject;

use Exception;
use Paydo\ValueObject\ValueObjectInterface;
use Throwable;

use function implode;
use function strrchr;
use function substr;

/**
 * Class AbstractInvalidValueException
 *
 * @package Paydo\Throwable\ValueObject
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
abstract class AbstractInvalidValueException extends Exception
{
    /**
     * AbstractInvalidValueException constructor.
     *
     * @param string $value
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $value = "", int $code = 0, Throwable $previous = null)
    {
        $message = sprintf(
            'The value "%s" is not a valid for instance of type "%s". Valid values: "%s".',
            $value,
            substr(strrchr('\\'.get_class($this->getValueObjectClass()), '\\'), 1),
            implode(',', $this->getValueObjectClass()::getValidValues())
        );

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ValueObjectInterface
     */
    abstract protected function getValueObjectClass(): ValueObjectInterface;
}
