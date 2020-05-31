<?php

declare(strict_types=1);

namespace Paydo\Util;

use Enuage\SchemaValidator\Configuration\StructureConfiguration;
use Enuage\SchemaValidator\Validator\SchemaValidator;
use Exception;
use Paydo\Throwable\MissingQueryParameterException;
use Paydo\ValueObject\Currency;
use Paydo\ValueObject\Product;

use function array_map;

/**
 * Class RequestResolver
 *
 * @package Paydo\Util
 * @author Serghei Niculaev <spam312sn@gmail.com>
 */
class RequestResolver
{
    /**
     * @param array $params
     *
     * @return Currency
     * @throws Exception
     */
    public static function getBaseCurrencyFromRequestQuery(array $params): Currency
    {
        $schema = new StructureConfiguration('parameters');
        $schema->addStringProperty('baseCurrency')->setRequired();

        $schemaValidator = new SchemaValidator();
        $validationResult = $schemaValidator->validate($params, $schema);

        if (false === $validationResult->isValid()) {
            throw new MissingQueryParameterException($validationResult->getErrors()->first()->getPointer());
        }

        return new Currency($params['baseCurrency']);
    }

    /**
     * @param array $params
     *
     * @return array|Product[]
     *
     * @throws Exception
     */
    public static function getProductsFromRequestQuery(array $params): array
    {
        $schema = new StructureConfiguration('parameters');
        $schema->addArrayProperty('products')->setRequired(); // TODO: `...->multipleOf('string')`

        $schemaValidator = new SchemaValidator();
        $validationResult = $schemaValidator->validate($params, $schema);

        if (false === $validationResult->isValid()) {
            throw new MissingQueryParameterException($validationResult->getErrors()->first()->getPointer());
        }

        return array_map(
            function (&$product) {
                return new Product($product);
            },
            $params['products']
        );
    }
}
