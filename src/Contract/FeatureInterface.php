<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Contract;

/**
 * Interface FeatureInterface
 *
 * This interface defines the methods that should be implemented
 * by a feature in a recommendation system.
 */
interface FeatureInterface
{
    /**
     * Transforms the input data using the encoder.
     *
     * @param string $input The input data to be transformed.
     * @return array The transformed data.
     */
    public function transform(string $input): array;

    /**
     * Calculates the similarity between two items based on the feature.
     *
     * @param array $input1 The first input item.
     * @param array $input2 The second input item.
     * @return float The similarity value between the two input items.
     */
    public function similarity(array $input1, array $input2): float;

    /**
     * Gets the unique values for the feature in the dataset.
     *
     * This method should be implemented by the classes to provide
     * the unique values that the encoder needs for transforming the input data.
     *
     * @return array An array of unique values for the feature.
     */
    public function getUniqueValues(): array;

    /**
     * Sets the unique values for the feature in the dataset.
     *
     * This method should be implemented by the classes to provide
     * the unique values that the encoder needs for transforming the input data.
     */
    public function setUniqueValues(array $uniqueValues): void;
}
