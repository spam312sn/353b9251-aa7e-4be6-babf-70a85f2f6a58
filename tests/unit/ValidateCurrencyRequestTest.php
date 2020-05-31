<?php

use Codeception\Test\Unit;
use Paydo\Throwable\MissingQueryParameterException;
use Paydo\Throwable\ValueObject\InvalidCurrencyValue;
use Paydo\Util\RequestResolver;
use Paydo\ValueObject\Currency;

/**
 * Class ValidateCurrencyRequestTest
 *
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class ValidateCurrencyRequestTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /** @noinspection PhpUnhandledExceptionInspection */
    public function testPositive()
    {
        $request = [
            'baseCurrency' => 'USD',
        ];

        $this->tester->assertInstanceOf(
            Currency::class,
            RequestResolver::getBaseCurrencyFromRequestQuery($request)
        );
    }

    public function testNegative()
    {
        $this->tester->expectThrowable(
            MissingQueryParameterException::class,
            function () {
                RequestResolver::getBaseCurrencyFromRequestQuery([]);
            }
        );
    }

    public function testInvalid()
    {
        $this->tester->expectThrowable(
            InvalidCurrencyValue::class,
            function () {
                RequestResolver::getBaseCurrencyFromRequestQuery(['baseCurrency' => 'LVL']);
            }
        );
    }
}
