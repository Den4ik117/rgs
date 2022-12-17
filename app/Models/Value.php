<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class Value
{
    public string $type;
    public string $column;
    public int $total;
    public int $min_value;
    public int $max_value;
    public int $min_values;
    public int $max_values;
    public int $sample_size;
    public int $intervals_number;
    public int $interval_value;
    /**
     * @var Collection<Interval>
     */
    public Collection $intervals;
    public float $M;
    public float $D;
    public float $s;
    public float $S2;
    public float $S;
    public float $A;
    public float $E;
    public string $fM;
    public string $fD;
    public string $fs;
    public string $fS2;
    public string $fS;
    public string $fA;
    public string $fE;

    public function __construct(EloquentCollection $users, string $type, int $intervals, int $total)
    {
        $this->type = $type;
        $this->column = 'total_' . $this->type;
        $this->total = $total;

        $this->min_value = $users->min($this->column);
        $this->max_value = $users->max($this->column);

        $this->min_values = $users->where($this->column, $this->min_value)->count();
        $this->max_values = $users->where($this->column, $this->max_value)->count();

        $this->sample_size = $this->max_value - $this->min_value;
        $this->intervals_number = $intervals;

        $this->interval_value = $this->sample_size / $this->intervals_number;

        $this->intervals = collect([]);
        for (
            $i = 0, $j = $this->min_value, $k = $this->min_value + $this->interval_value;
            $i < $this->intervals_number;
            $i++, $j += $this->interval_value, $k += $this->interval_value
        ) {
            $between = [$i === 0 ? $j : $j + 1, $k];
            $ni = $users->whereBetween($this->column, $between)->count();
            $interval = new Interval([$j, $k], $ni, $ni / $this->total, ($j + $k) / 2);
            $this->intervals->push($interval);
        }

        $this->M = $this->intervals->map(fn (Interval $in) => $in->wi * $in->middle)->sum();
        $this->D = round($this->intervals->map(fn (Interval $in) => $in->wi * pow($in->middle, 2))->sum() - pow($this->M, 2), 4);
        $this->s = round(sqrt($this->D), 4);
        $this->S2 = round(($this->total / ($this->total - 1)) * $this->D, 4);
        $this->S = round(sqrt($this->S2), 4);
        $this->A = round($this->intervals->map(fn (Interval $in) => pow(($in->middle - $this->M), 3) * $in->wi)->sum() / pow($this->S, 3), 4);
        $this->E = round($this->intervals->map(fn (Interval $in) => pow(($in->middle - $this->M), 4) * $in->wi)->sum() / pow($this->S, 4) - 3   , 4);

        $this->fM = $this->intervals->map(fn (Interval $in) => $in->wi . '\cdot' . $in->middle)->take(7)->implode('+') . ' + \dots';
        $this->fD = $this->intervals->map(fn (Interval $in) => $in->wi . '\cdot' . $in->middle . '^2')->take(6)->implode('+') . ' + \dots - (' . $this->M . ')^2';
        $this->fs = '\sqrt{' . $this->D . '}';
        $this->fS2 = '\frac{' . $this->total . '}{' . $this->total . ' - 1}' . '\cdot' . $this->D;
        $this->fS = '\sqrt{' . $this->S2 . '}';
        $this->fA = '\frac{' . $this->intervals->map(fn (Interval $in) => '(' . $in->middle . ' - ' . $this->M . ')^3' . '\cdot' . $in->wi)->take(4)->implode('+') . ' + \dots}{' . $this->S . '^3}';
        $this->fE = '\frac{' . $this->intervals->map(fn (Interval $in) => '(' . $in->middle . ' - ' . $this->M . ')^4' . '\cdot' . $in->wi)->take(4)->implode('+') . ' + \dots}{' . $this->S . '^4} - 3';

//        $this->fM = $this->intervals->map(fn (Interval $in) => $in->wi . '\dot' . $in->middle)->implode('+');
//        dd($this);
    }
}
