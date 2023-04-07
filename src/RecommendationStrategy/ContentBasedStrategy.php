<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\RecommendationStrategy;

use Drishu\RecommendationSystem\Contract\RecommendationStrategyInterface;
use Drishu\RecommendationSystem\Contract\FeatureInterface;

/**
 * Class ContentBasedRecommender
 *
 * This class implements a content-based recommendation system.
 * It takes into account features of the items to calculate the similarity between them.
 * Based on these similarities, the system can recommend items that are similar to the ones
 * a user has interacted with before.
 */
class ContentBasedRecommender implements RecommendationStrategyInterface
{
    /**
     * @var FeatureInterface[] An array of features used to calculate the similarity between items.
     */
    protected $features;

    /**
     * ContentBasedRecommender constructor.
     *
     * @param FeatureInterface[] $features An array of features used to calculate the similarity between items.
     */
    public function __construct(array $features)
    {
        $this->features = $features;
    }

    /**
     * {@inheritDoc}
     */
    public function calculateSimilarity(array $item1, array $item2): float
    {
        $totalSimilarity = 0;
        $totalFeatures = count($this->features);

        foreach ($this->features as $feature) {
            $transformedItem1 = $feature->transform($item1);
            $transformedItem2 = $feature->transform($item2);
            $totalSimilarity += $feature->similarity($transformedItem1, $transformedItem2);
        }

        return $totalSimilarity / $totalFeatures;
    }

    /**
     * {@inheritDoc}
     */
    public function recommend(array $userInteractions, array $allItems): array
    {
        $scores = [];

        foreach ($allItems as $item) {
            $totalSimilarity = 0;

            foreach ($userInteractions as $interaction) {
                $totalSimilarity += $this->calculateSimilarity($item, $interaction);
            }

            $scores[$item['id']] = $totalSimilarity / count($userInteractions);
        }

        arsort($scores);

        $recommendedItems = array_keys($scores);

        return $recommendedItems;
    }
}
