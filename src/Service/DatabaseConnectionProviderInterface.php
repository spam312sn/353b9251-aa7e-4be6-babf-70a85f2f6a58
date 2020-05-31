<?php

declare(strict_types=1);

namespace Paydo\Service;

use Aura\Sql\AbstractExtendedPdo;

/**
 * Interface DatabaseConnectionProviderInterface
 *
 * @package Paydo\Service
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
interface DatabaseConnectionProviderInterface
{
    /**
     * @return AbstractExtendedPdo
     */
    public function getConnection(): AbstractExtendedPdo;
}
