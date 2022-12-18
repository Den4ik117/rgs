<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Collection;

class UsersReport
{
//    const X_INTERVALS = 10;
//    const Y_INTERVALS = 11;

    public readonly UsersValue $x;
    public readonly UsersValue $y;
    public readonly int $total;
    public readonly array $doubleXY;

    public function __construct(Collection $collection, int $x_intervals, int $y_intervals)
    {
        $this->total = $collection->count();

        $this->x = new UsersValue($collection, 'x', $x_intervals, $this->total);
        $this->y = new UsersValue($collection, 'y', $y_intervals, $this->total);

        $doubleXY = [
            'values' => [],
            'nx' => [],
            'intermediate' => [],
            'yx' => [],
            'points' => [],
            'XY' => [],
            '$XY' => []
        ];
        $i = 0;
        foreach ($this->x->intervals as $int_x) {
            foreach ($this->y->intervals as $int_y) {
                $countUsers = $collection
                        ->whereBetween($this->x->column, [$int_x->interval[0] === $this->x->min_value ? $int_x->interval[0] : $int_x->interval[0] + 1, $int_x->interval[1]])
                        ->whereBetween($this->y->column, [$int_y->interval[0] === $this->y->min_value ? $int_y->interval[0] : $int_y->interval[0] + 1, $int_y->interval[1]])
                        ->count();
                $doubleXY['values'][$int_x->middle . ' ' . $int_y->middle] = $countUsers;
                $doubleXY['intermediate'][] = $countUsers * $int_y->middle;
                $doubleXY['$intermediate'][] = $countUsers . '\cdot' . $int_y->middle;
                $doubleXY['XY'][] = $int_x->middle * $int_y->middle * $countUsers;
                if ($i < 8) {
                    $doubleXY['$XY'][] = $int_x->middle . '\cdot' . $int_y->middle . '\cdot' . $countUsers;
                }
                $i++;
            }
            $nx = $collection
                    ->whereBetween($this->x->column, [$int_x->interval[0] === $this->x->min_value ? $int_x->interval[0] : $int_x->interval[0] + 1, $int_x->interval[1]])
                    ->count();
            $doubleXY['nx'][] = $nx;
            $doubleXY['yx'][] = round((array_sum($doubleXY['intermediate'])) / ($nx === 0 ? 0.00001 : $nx), 4);
            $doubleXY['$yx'][] = ['key' => $int_x->middle, 'value' => '(' . implode('+', $doubleXY['$intermediate']) . ') \frac{1}{' . $nx . '}'];
            $doubleXY['points'][] = ['x' => $int_x->middle, 'y' => end($doubleXY['yx'])];
            $doubleXY['intermediate'] = [];
            $doubleXY['$intermediate'] = [];
        }
        $doubleXY['XY'] = round(array_sum($doubleXY['XY']) / $this->total, 4);
        $doubleXY['$XY'] = '(' . implode('+', $doubleXY['$XY']) . ' + \dots) \frac{1}{' . $this->total . '}';
        $doubleXY['KXY'] = round($doubleXY['XY'] - $this->x->M * $this->y->M, 4);
        $doubleXY['rxy'] = round($doubleXY['KXY'] / ($this->x->S * $this->y->S), 4);

        $this->doubleXY = $doubleXY;
    }

    public function y(int $x): float
    {
        return $this->doubleXY['rxy'] * ($this->y->S / $this->x->S) * ($x - $this->x->M) + $this->y->M;
    }
}
