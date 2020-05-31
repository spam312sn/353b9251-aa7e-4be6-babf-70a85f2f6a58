<?php

declare(strict_types=1);

namespace Paydo\Filter\DTO;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Enuage\Type\Helper\Type;
use Enuage\Type\PseudoGeneric;
use Exception;
use Paydo\DTO\DateDTO;
use Paydo\ValueObject\Product;

use function intval;

/**
 * Class BasicFilter
 *
 * @package Paydo\DTO
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class BasicFilter
{
    /**
     * @var DateDTO
     */
    private DateDTO $dates;

    /**
     * @var PseudoGeneric<Product>
     */
    private PseudoGeneric $products;

    /**
     * @var DateDTO
     */
    private DateDTO $previousDates;

    /**
     * BasicFilter constructor.
     *
     * @param DateTimeInterface $from
     * @param DateTimeInterface $to
     * @param array $products
     *
     * @throws Exception
     */
    public function __construct(DateTimeInterface $from, DateTimeInterface $to, array $products)
    {
        $this->dates = new DateDTO($from, $to);
        $this->products = new PseudoGeneric(Product::class, Type::INTEGER_TYPE, $products);

        if (0 === intval($from->format('z')) && 363 < intval($to->format('z'))) {
            $modifier = '-1 year';
        } elseif (1 === intval($from->format('j')) && $to->format('t') === $to->format('j')) {
            $modifier = '-1 month';
        } else {
            $interval = $from->diff($to)->d;
            $modifier = '-'.$interval.' days';
        }

        $this->previousDates = new DateDTO(self::modifyDate($from, $modifier), self::modifyDate($to, $modifier),);
    }

    private static function modifyDate(DateTimeInterface $date, string $period)
    {
        return DateTime::createFromFormat('Y-m-d', $date->format('Y-m-d'))->modify($period);
    }

    /**
     * @return DateTimeImmutable
     */
    public function getFrom(): DateTimeImmutable
    {
        return $this->dates->getFrom();
    }

    /**
     * @return DateTimeImmutable
     */
    public function getTo(): DateTimeImmutable
    {
        return $this->dates->getTo();
    }

    /**
     * @return PseudoGeneric
     */
    public function getProducts(): PseudoGeneric
    {
        return $this->products;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getPreviousFrom(): DateTimeImmutable
    {
        return $this->previousDates->getFrom();
    }

    /**
     * @return DateTimeImmutable
     */
    public function getPreviousTo(): DateTimeImmutable
    {
        return $this->previousDates->getTo();
    }
}
