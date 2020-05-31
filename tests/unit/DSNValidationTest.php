<?php

use Codeception\Test\Unit;
use Paydo\Service\DatabaseConnectionProvider;
use Paydo\Throwable\MissingConfigException;

class DSNValidationTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testValid()
    {
        $provider = new DatabaseConnectionProvider('mysql:host=localhost;dbname=test;charset=utf8', 'test', 'test');

        $this->tester->assertInstanceOf(PDO::class, $provider->getConnection());
    }

    public function testInvalid()
    {
        $this->tester->expectThrowable(
            MissingConfigException::class,
            function () {
                new DatabaseConnectionProvider('mysql:host=localhost;dbname=test', 'test', 'test');
            }
        );
    }
}
