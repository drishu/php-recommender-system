<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\RecommendationStrategy;

use Drishu\RecommendationSystem\Contract\RecommendationStrategyInterface;

class RandomGuessingStrategy implements RecommendationStrategyInterface
{
    public function estimateUserRating($movie_id, $user_id, $mysqli)
    {
        return rand(1, 5);
    }

    public function calculateSimilarity(array $item1, array $item2): float
    {
        return 0;
    }

    public function recommend(array $userInteractions, array $allItems): array
    {
        return [];
    }
}
