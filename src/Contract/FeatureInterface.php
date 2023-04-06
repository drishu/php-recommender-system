<?php

declare(strict_types=1);

namespace Drishu\RecommendationSystem\Contract;

interface Feature
{
    public function similarity(array $vector1, array $vector2): float;
}