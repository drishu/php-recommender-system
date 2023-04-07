<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Utils;

use Drishu\RecommendationSystem\Contract\EncoderInterface;

/**
 * Class OneHotEncoder
 *
 * This class is used for performing one-hot encoding on categorical data.
 */
class OneHotEncoder implements EncoderInterface
{
    /**
     * {@inheritDoc}
     */
    public static function transform(string $data, array $uniqueValues, string $separator = ','): array
    {
        $values = explode($separator, $data);
        $values = array_map('trim', $values);

        return self::encode($values, $uniqueValues);
    }

    /**
     * {@inheritDoc}
     */
    public static function encode(array $values, array $uniqueValues): array
    {
        $binaryVector = array_fill(0, count($uniqueValues), 0);

        foreach ($values as $value) {
            $index = array_search($value, $uniqueValues, true);
            if ($index !== false) {
                $binaryVector[$index] = 1;
            }
        }

        return $binaryVector;
    }
}
