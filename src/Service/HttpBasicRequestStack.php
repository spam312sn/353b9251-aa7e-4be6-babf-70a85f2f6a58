<?php

declare(strict_types=1);

namespace Paydo\Service;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Class HttpBasicRequestStack
 *
 * @package Paydo\Service
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class HttpBasicRequestStack implements HttpBasicRequestStackInterface
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * @var RequestFactoryInterface
     */
    private RequestFactoryInterface $requestFactory;

    /**
     * HttpBasicRequestStack constructor.
     *
     * @param ClientInterface $client
     * @param RequestFactoryInterface $requestFactory
     */
    public function __construct(ClientInterface $client, RequestFactoryInterface $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @inheritDoc
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @inheritDoc
     */
    public function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }
}
