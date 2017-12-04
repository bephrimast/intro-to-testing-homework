<?php

class FrogJump
{
    public function solution($startingPosition, $targetPosition, $distance)
    {
        if ($targetPosition < $startingPosition) {
            throw new LogicException('Target position must be greater than starting position');
        }

        return (int) ceil(($targetPosition - $startingPosition) / $distance);
    }
}