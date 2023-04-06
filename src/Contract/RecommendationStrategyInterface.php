<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Contract;

interface RecommendationStrategyInterface
{
    public function estimateUserRating($movie_id, $user_id, $mysqli);
}
