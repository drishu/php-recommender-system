<?php

namespace Drishu\RecommendationSystem\Contract;

interface RecommendationStrategyInterface
{
    public function estimateUserRating($movie_id, $user_id, $mysqli);
}
