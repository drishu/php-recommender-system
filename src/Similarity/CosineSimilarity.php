<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Similarity;

use Drishu\RecommendationSystem\Contract\SimilarityInterface;

class CosineSimilarity implements SimilarityInterface
{
    /**
     * Calculate Cosine Similarity between two sets.
     *
     * @param array $set1 An associative array representing the first set with keys as features and values as weights.
     * @param array $set2 An associative array representing the second set with keys as features and values as weights.
     *
     * @return float The Cosine Similarity between the two sets, ranging from -1 to 1.
     */
    public function calculate(array $set1, array $set2): float
    {
        $dotProduct = 0.0;
        $magnitudeSet1 = 0.0;
        $magnitudeSet2 = 0.0;

        // Calculate dot product and magnitude of the first set
        foreach ($set1 as $feature => $weight) {
            $magnitudeSet1 += pow($weight, 2);

            if (isset($set2[$feature])) {
                $dotProduct += $weight * $set2[$feature];
            }
        }

        // Calculate magnitude of the second set
        foreach ($set2 as $weight) {
            $magnitudeSet2 += pow($weight, 2);
        }

        // Handle edge cases where magnitudes are 0
        if ($magnitudeSet1 == 0 || $magnitudeSet2 == 0) {
            return 0.0;
        }

        // Calculate and return Cosine Similarity
        return $dotProduct / (sqrt($magnitudeSet1) * sqrt($magnitudeSet2));
    }
}
