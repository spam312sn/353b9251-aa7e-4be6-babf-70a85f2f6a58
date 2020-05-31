<?php


declare(strict_types=1);

namespace Paydo\Service;


use Aura\Sql\AbstractExtendedPdo;
use Aura\Sql\DecoratedPdo;
use Aura\Sql\ExtendedPdo;
use PDO;

class DatabaseConnectionFromPdoProvider implements DatabaseConnectionProviderInterface
{
    /**
     * @var DecoratedPdo
     */
    private $pdo;

    /**
     * DatabaseConnectionFromPdoProvider constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        if (false === ($pdo instanceof ExtendedPdo)) {
            $pdo = new DecoratedPdo($pdo);
        }

        $this->pdo = $pdo;
    }

    /**
     * {@inheritDoc}
     */
    public function getConnection(): AbstractExtendedPdo
    {
        return $this->pdo;
    }
}
