<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Collection;

class Report
{
    const X_INTERVALS = 10;
    const Y_INTERVALS = 11;

    public readonly Value $x;
    public readonly Value $y;
    public readonly int $total;
    public readonly array $doubleXY;

    public function __construct(Collection $users)
    {
        $this->total = $users->count();

        $this->x = new Value($users, 'x', self::X_INTERVALS, $this->total);
        $this->y = new Value($users, 'y', self::Y_INTERVALS, $this->total);

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
                $countUsers = $users
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
            $nx = $users
                    ->whereBetween($this->x->column, [$int_x->interval[0] === $this->x->min_value ? $int_x->interval[0] : $int_x->interval[0] + 1, $int_x->interval[1]])
                    ->count();
            $doubleXY['nx'][] = $nx;
            $doubleXY['yx'][] = round((array_sum($doubleXY['intermediate'])) / $nx, 4);
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
}
