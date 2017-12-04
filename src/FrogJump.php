<?php

class FrogJump{

    public function solution($x, $y, $d){

        $jumps = ceil(($y - $x) / $d);
        return (int) $jumps;
    }

}