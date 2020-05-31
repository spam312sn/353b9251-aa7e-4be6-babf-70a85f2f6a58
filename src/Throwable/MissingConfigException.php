<?php

declare(strict_types=1);

namespace Paydo\Throwable;

use LogicException;
use Throwable;

use function sprintf;

/**
 * Class MissingConfigException
 *
 * @package Paydo\Throwable
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class MissingConfigException extends LogicException
{
    /**
     * MissingConfigException constructor.
     *
     * @param string $dns
     * @param string $parameter
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $dns, string $parameter, int $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Parameter "%s" is missing in the dns: "%s".', $parameter, $dns),
            $code,
            $previous
        );
    }
}
