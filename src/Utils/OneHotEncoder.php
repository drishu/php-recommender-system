<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Utils;

/**
 * Class OneHotEncoder
 *
 * This class is used for performing one-hot encoding on categorical data.
 */
class OneHotEncoder
{
    /**
     * Transforms the given string into a one-hot encoded binary vector.
     *
     * @param string $data         The input data as a string with values separated by the given separator.
     * @param array  $uniqueValues The array of unique values that can appear in the data.
     * @param string $separator    The separator used to split the input data string (default is a comma).
     *
     * @return array The one-hot encoded binary vector.
     */
    public static function transform(string $data, array $uniqueValues, string $separator = ','): array
    {
        $values = explode($separator, $data);
        $values = array_map('trim', $values);

        return self::encode($values, $uniqueValues);
    }

    /**
     * Encodes the given array of values into a one-hot encoded binary vector.
     *
     * @param array $values       The input data as an array of values.
     * @param array $uniqueValues The array of unique values that can appear in the data.
     *
     * @return array The one-hot encoded binary vector.
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
