<?php

declare(strict_types=1);

namespace Paydo\Filter\DTO;

use Enuage\Type\Helper\Type;
use Enuage\Type\PseudoGeneric;
use Exception;
use Paydo\ValueObject\Currency;

/**
 * Class Filter
 *
 * @package Paydo\DTO
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class Filter extends BasicFilter
{
    /**
     * @var PseudoGeneric|null
     */
    private ?PseudoGeneric $merchants;

    /**
     * @var Currency
     */
    private ?Currency $baseCurrency;

    /**
     * @var Currency
     */
    private ?Currency $targetCurrency;

    /**
     * @var float
     */
    private ?float $exchangeRate;

    /**
     * @return PseudoGeneric|null
     */
    public function getMerchants(): ?PseudoGeneric
    {
        return $this->merchants;
    }

    /**
     * @param array $merchants
     *
     * @return $this
     *
     * @throws Exception
     */
    public function setMerchants(array $merchants): Filter
    {
        foreach ($merchants as $merchant) {
            $this->addMerchant($merchant);
        }

        return $this;
    }

    /**
     * @param string $merchant
     *
     * @return $this
     *
     * @throws Exception
     */
    public function addMerchant(string $merchant): Filter
    {
        if (null === $this->merchants) {
            $this->merchants = new PseudoGeneric(Type::STRING_TYPE);
        }

        $this->merchants->push($merchant);

        return $this;
    }

    /**
     * @return Currency
     */
    public function getBaseCurrency(): Currency
    {
        return $this->baseCurrency;
    }

    /**
     * @param Currency $baseCurrency
     *
     * @return Filter
     */
    public function setBaseCurrency(Currency $baseCurrency): Filter
    {
        $this->baseCurrency = $baseCurrency;

        return $this;
    }

    /**
     * @return Currency
     */
    public function getTargetCurrency(): Currency
    {
        return $this->targetCurrency;
    }

    /**
     * @param Currency $targetCurrency
     *
     * @return Filter
     */
    public function setTargetCurrency(Currency $targetCurrency): Filter
    {
        $this->targetCurrency = $targetCurrency;

        return $this;
    }

    /**
     * @return float
     */
    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }

    /**
     * @param float $exchangeRate
     *
     * @return Filter
     */
    public function setExchangeRate(float $exchangeRate): Filter
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }
}
