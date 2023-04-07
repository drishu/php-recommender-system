<?php

declare(strict_types=1);

use Drishu\RecommendationSystem\Contract\EncoderInterface;
use Drishu\RecommendationSystem\Contract\FeatureInterface;
use Drishu\RecommendationSystem\Contract\SimilarityInterface;

/**
 * Class AbstractFeature
 *
 * This is an abstract class for representing a feature in a recommendation system.
 * It provides a general implementation for transforming input data and calculating
 * similarity between two items based on the feature.
 */
abstract class AbstractFeature implements FeatureInterface
{
    /**
     * @var \Drishu\RecommendationSystem\Contract\SimilarityInterface The similarity metric to be used for this feature.
     */
    protected $similarity;

    /**
     * @var \Drishu\RecommendationSystem\Contract\EncoderInterface The encoder to be used for transforming input data.
     */
    protected $encoder;

    /**
     * @var array The unique values for the feature.
     */
    protected $uniqueValues;

    /**
     * Feature constructor.
     *
     * @param \Drishu\RecommendationSystem\Contract\SimilarityInterface $similarity The similarity metric to be used for this feature.
     * @param \Drishu\RecommendationSystem\Contract\EncoderInterface $encoder The encoder to be used for transforming input data.
     */
    public function __construct(SimilarityInterface $similarity, EncoderInterface $encoder)
    {
        $this->similarity = $similarity;
        $this->encoder = $encoder;
    }

    /**
     * {@inheritDoc}
     */
    public function transform(string $input): array
    {
        return $this->encoder->transform($input, $this->getUniqueValues());
    }

    /**
     * {@inheritDoc}
     */
    public function similarity(array $input1, array $input2): float
    {
        return $this->similarity->calculate($input1, $input2);
    }

    /**
     * {@inheritDoc}
     */
    public function getUniqueValues(): array {
        return $this->uniqueValues;
    }

    /**
     * {@inheritDoc}
     */
    abstract function setUniqueValues(array $uniqueValues): void;
}
