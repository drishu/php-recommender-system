<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Contract;

/**
 * Interface EncoderInterface
 *
 * This interface defines the contract for implementing an encoder.
 * An encoder should be able to transform input data into a specific format.
 */
interface EncoderInterface
{
    /**
     * Transform the input data into the desired format.
     *
     * @param string $data The input data to be transformed.
     * @param array $uniqueValues An array containing the unique values in the dataset.
     * @param string $separator (Optional) A separator for splitting the input data.
     * @return array The transformed data in the desired format.
     */
    public static function transform(string $data, array $uniqueValues, string $separator = ','): array;
}
