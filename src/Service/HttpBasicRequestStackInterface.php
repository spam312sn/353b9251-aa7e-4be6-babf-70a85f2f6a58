<?php

declare(strict_types=1);

namespace Paydo\Service;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Interface HttpBasicRequestStackInterface
 *
 * @package Paydo\Service
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
interface HttpBasicRequestStackInterface
{
    /**
     * @return ClientInterface
     *
     */
    public function getClient(): ClientInterface;

    /**
     * @return RequestFactoryInterface
     */
    public function getRequestFactory(): RequestFactoryInterface;
}
