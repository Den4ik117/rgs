<?php

namespace App\Models;

class Interval
{
    public readonly array $interval;
    public readonly int $ni;
    public readonly float $wi;
    public readonly int $middle;

    public function __construct(array $interval, int $ni, float $wi, int $middle)
    {
        $this->interval = $interval;
        $this->ni = $ni;
        $this->wi = round($wi, 4);
        $this->middle = $middle;
    }
}
