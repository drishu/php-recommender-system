<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Contract;

/**
 * Interface RecommendationStrategyInterface
 *
 * This interface represents the contract for recommendation strategies.
 * It defines methods that any recommendation strategy should implement.
 */
interface RecommendationStrategyInterface
{
    /**
     * Calculate the similarity score between two items using the features.
     *
     * @param array $item1 The first item.
     * @param array $item2 The second item.
     * @return float The similarity score between the two items.
     */
    public function calculateSimilarity(array $item1, array $item2): float;

    /**
     * Recommend items for a user based on their past interactions and the similarity between items.
     *
     * @param array $userInteractions The user's past interactions with items.
     * @param array $allItems All available items for recommendation.
     * @return array The recommended items for the user.
     */
    public function recommend(array $userInteractions, array $allItems): array;
}
