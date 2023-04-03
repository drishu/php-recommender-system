<?php

namespace Drishu\RecommendationSystem\RecommendationStrategy;

use Drishu\RecommendationSystem\Contract\RecommendationStrategyInterface;

class RandomGuessingStrategy implements RecommendationStrategyInterface
{
    public function estimateUserRating($movie_id, $user_id, $mysqli)
    {
        return rand(1, 5);
    }
}
