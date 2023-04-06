<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Contract;

interface SimilarityInterface
{
    public function calculate(array $set1, array $set2): float;
}
