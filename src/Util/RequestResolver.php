<?php

declare(strict_types=1);

namespace Paydo\Util;

use Enuage\SchemaValidator\Configuration\StructureConfiguration;
use Enuage\SchemaValidator\Constraint\ArrayConstraint;
use Enuage\SchemaValidator\Constraint\StringConstraint;
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
     *
     * @throws Exception
     */
    public static function getBaseCurrencyFromRequestQuery(array $params): Currency
    {
        $params = self::validateRequest(
            $params,
            [
                (new StringConstraint('baseCurrency', 0))->setRequired(), // TODO: `...->setAllowedValues()`
            ]
        );

        return new Currency($params['baseCurrency']);
    }

    /**
     * @param array $params
     * @param array $constraints
     *
     * @return array
     *
     * @throws Exception
     */
    private static function validateRequest(array $params, array $constraints): array
    {
        $schema = new StructureConfiguration('parameters');
        foreach ($constraints as $constraint) {
            $schema->addConstraint($constraint);
        }

        $schemaValidator = new SchemaValidator();
        $validationResult = $schemaValidator->validate($params, $schema);

        if (false === $validationResult->isValid()) {
            throw new MissingQueryParameterException($validationResult->getErrors()->first()->getPointer());
        }

        return $params;
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
        $params = self::validateRequest(
            $params,
            [
                (new ArrayConstraint('products', 0))->setRequired(), // TODO: `...->multipleOf('string')`
            ]
        );

        return array_map(
            function ($product) {
                return new Product($product);
            },
            $params['products']
        );
    }
}
