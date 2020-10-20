<?php

/**
 * @author Zahir
 */
class Lcg {

    public function __construct($modulus, $multiplier, $increment, $seed) {
        $this->modulus = $modulus;
        $this->multiplier = $multiplier;
        $this->increment = $increment;
        $this->seed = $seed;
    }

    public function next() {
        // Y = (a.X + c) mod m
        $val = ($this->multiplier * $this->seed) + $this->increment;
        $this->seed = $val % $this->modulus;
        return $this->seed;
    }

}
