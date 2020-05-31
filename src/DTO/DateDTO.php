<?php

declare(strict_types=1);

namespace Paydo\DTO;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;

/**
 * Class DateDTO
 *
 * @package Paydo\DTO
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class DateDTO
{
    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $from;

    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $to;

    /**
     * DateDTO constructor.
     *
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     *
     * @throws Exception
     */
    public function __construct(DateTimeInterface $from, DateTimeInterface $to)
    {
        $this->from = new DateTimeImmutable($from->format('Y-m-d 00:00:00'));
        $this->to = new DateTimeImmutable($to->format('Y-m-d 23:59:59'));
    }

    /**
     * @return DateTimeImmutable
     */
    public function getFrom(): DateTimeImmutable
    {
        return $this->from;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getTo(): DateTimeImmutable
    {
        return $this->to;
    }
}
