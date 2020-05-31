<?php

declare(strict_types=1);

namespace Paydo\Throwable;

use RuntimeException;
use Throwable;

use function sprintf;

/**
 * Class MissingQueryParameterException
 *
 * @package Paydo\Throwable
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class MissingQueryParameterException extends RuntimeException
{
    /**
     * MissingQueryParameterException constructor.
     *
     * @param string $missingParameter
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $missingParameter, int $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Parameter "%s" is missing in the query.', $missingParameter),
            $code,
            $previous
        );
    }
}
