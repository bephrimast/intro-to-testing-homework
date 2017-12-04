<?php

class Calculator{

    public function add($a, $b){
        return $a + $b;
    }

    public function substract($a, $b){
        return $a - $b;
    }

    public function multiply($a, $b){
        return $a * $b;
    }

    public function calculateWithPercentage($input, $percentage){

        if (is_float($input)) {
            //return round($input * (100 + $percentage)/100, 2);
            return $result = ceil(($input * 100) * (100 + $percentage)/100) / 100;
        }else{
        return ceil($input * (100 + $percentage)/100);
        }
    }

}