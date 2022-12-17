<?php

namespace App\Models\Report;

class Interval
{
    public readonly int $total;
    public readonly array $interval;
    public readonly int $ni;
    public readonly float $wi;
    public readonly int $middle;
    public readonly float $accumulative;
    public float $M;
    public float $pi;
    public float $pni;
    public float $dni;
    public float $dni2;
    public float $pearson;

    public function __construct(array $interval, int $ni, float $wi, int $middle, float $accumulative, int $total)
    {
        $this->interval = $interval;
        $this->ni = $ni;
        $this->wi = round($wi, 4);
        $this->middle = $middle;
        $this->accumulative = $accumulative;
        $this->total = $total;
    }

    public function setM(float $M): void
    {
        $this->M = $M;

        $this->pi = round(exp(-($this->interval[0]) / ($this->M)) - exp(-($this->interval[1]) / ($this->M)), 4);
        $this->pni = round($this->total * $this->pi);
        $this->dni = $this->ni - $this->pni;
        $this->dni2 = pow($this->dni, 2);
        $this->pearson = round($this->dni2 / ($this->pni == 0 ? 0.00000001 : $this->pni), 4);
    }
}
