<?php

use Codeception\Test\Unit;
use Paydo\Throwable\MissingQueryParameterException;
use Paydo\Throwable\ValueObject\InvalidProductValue;
use Paydo\Util\RequestResolver;
use Paydo\ValueObject\Product;

/**
 * Class ValidateProductsRequestTest
 *
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class ValidateProductsRequestTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /** @noinspection PhpUnhandledExceptionInspection */
    public function testPositive()
    {
        $request = [
            'products' => [
                'ECOM',
                'POS',
            ],
        ];

        $products = RequestResolver::getProductsFromRequestQuery($request);
        $this->tester->assertIsArray($products);

        foreach ($products as $product) {
            $this->tester->assertInstanceOf(Product::class, $product);
        }
    }

    public function testNegative()
    {
        $this->tester->expectThrowable(
            MissingQueryParameterException::class,
            function () {
                RequestResolver::getProductsFromRequestQuery([]);
            }
        );

        $this->tester->expectThrowable(
            MissingQueryParameterException::class,
            function () {
                RequestResolver::getProductsFromRequestQuery(['products' => 'test']);
            }
        );
    }

    public function testInvalid()
    {
        $this->tester->expectThrowable(
            InvalidProductValue::class,
            function () {
                RequestResolver::getProductsFromRequestQuery(['products' => ['test']]);
            }
        );
    }
}
