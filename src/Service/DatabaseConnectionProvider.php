<?php

declare(strict_types=1);

namespace Paydo\Service;

use Aura\Sql\AbstractExtendedPdo;
use Aura\Sql\ExtendedPdo;
use Exception;
use Paydo\Throwable\MissingConfigException;

/**
 * Class DatabaseConnectionProvider
 *
 * @package Paydo\Service
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class DatabaseConnectionProvider implements DatabaseConnectionProviderInterface
{
    /**
     * @var ExtendedPdo
     */
    private ExtendedPdo $connection;

    /**
     * DatabaseConnectionProvider constructor.
     *
     * @param string $pdoDsn
     * @param string $username
     * @param string $password
     *
     * @throws Exception
     */
    public function __construct(string $pdoDsn, string $username, string $password)
    {
        if (false === str_contains(strtolower($pdoDsn), 'charset=')) {
            throw new MissingConfigException($pdoDsn, 'CharSet');
        }

        $this->connection = new ExtendedPdo($pdoDsn, $username, $password);
    }

    /**
     * {@inheritDoc}
     */
    public function getConnection(): AbstractExtendedPdo
    {
        return $this->connection;
    }
}
