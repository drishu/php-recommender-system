<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Similarity;

use Drishu\RecommendationSystem\Contract\SimilarityInterface;

class JaccardSimilarity implements SimilarityInterface
{
    public function calculate(array $set1, array $set2): float
    {
        $intersection = count(array_intersect($set1, $set2));
        $union = count(array_unique(array_merge($set1, $set2)));

        if ($union === 0) {
            return 0;
        }

        return $intersection / $union;
    }
}

