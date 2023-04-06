<?php

namespace Drishu\RecommendationSystem\Contract;

interface Feature
{
    public function similarity(array $vector1, array $vector2): float;
}