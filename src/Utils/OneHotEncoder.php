<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Utils;

class OneHotEncoder
{
    public static function transform(string $data, array $uniqueValues, string $separator = ','): array
    {
        $binaryVector = array_fill(0, count($uniqueValues), 0);

        if ($separator) {
            $values = explode($separator, $data);
            foreach ($values as $value) {
                $index = array_search(trim($value), $uniqueValues, true);
                if ($index !== false) {
                    $binaryVector[$index] = 1;
                }
            }
        } else {
            $index = array_search($data, $uniqueValues, true);
            if ($index !== false) {
                $binaryVector[$index] = 1;
            }
        }

        return $binaryVector;
    }
}
