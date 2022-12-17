<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->whereNotNull('total_x')
            ->whereNotNull('total_y')
            ->get()
            ->shuffle();

        $report = new Report($users);
//        dd($users);

//        $totalUsers = $users->count();

        $chunkSize = 9;

//        $usersSortedByX = $users->groupBy('total_x')->sortKeys()->values();
//        $usersSortedByY = $users->groupBy('total_y')->sortKeys()->values();

//        $xMin = $usersSortedByX->first();
//        $xMax = $usersSortedByX->last();
//        $n = 1 + 3.22 * (log($totalUsers) / log(10));
//        $resultN = ceil($n);
//        $resultN
//        $h = $report->x->interval_value;
//        $leftSpacing = $xMin->first()->total_x;
//        $rightSpacing = $leftSpacing + $h;
//        $intervals = [];
//        for ($i = 0; $i < $resultN; $i++) {
//            $interval = [];
//            $n_i = $users->whereBetween('total_x', [$i === 0 ? $leftSpacing : $leftSpacing + 1, $rightSpacing])->count();
//            $interval['interval'] = ($i === 0 ? '[' : '(') . $leftSpacing . '; ' . $rightSpacing . ']';
//            $interval['count'] = $n_i;
//            $interval['frequency'] = round($n_i / $totalUsers, 4);
//            $interval['middle'] = ($leftSpacing + $rightSpacing) / 2;
//
//            $leftSpacing += $h;
//            $rightSpacing += $h;
//            $intervals[] = $interval;
//        }

//        $leftSpacing = $xMin->first()->total_x;
//        $leftSpacing = $report->x->min_value;
//        $rightSpacing = $leftSpacing + $report->x->interval_value;
//        $empiricalFunctionArray = [];
//        $empiricalFunctionArray[] = [PHP_INT_MIN, $leftSpacing];
//        for ($i = 0; $i < $report->x->intervals_number; $i++) {
//            $empiricalFunctionArray[] = [$leftSpacing, $rightSpacing];
//            $leftSpacing += $report->x->interval_value;
//            $rightSpacing += $report->x->interval_value;
//        }
//        $empiricalFunctionArray[] = [$leftSpacing, PHP_INT_MAX];
//        $empiricalFunctionArray = array_map(function ($intervals) use ($totalUsers, $users) {
//            $result = /*User::query()
//                    ->whereNotNull('total_x')
//                    ->whereNotNull('total_y')*/
//
//                    $users
//                    ->where('total_x', '<', $intervals[1])
//                    ->count() / $totalUsers;
//            return [
//                'left' => $intervals[0] === PHP_INT_MIN ? '-\infty' : $intervals[0],
//                'x' => $intervals[1] === PHP_INT_MAX ? '+\infty' : $intervals[1],
//                'y' => round($result, 4)
//            ];
//        }, $empiricalFunctionArray);
//        dd(User::query()
//            ->whereNotNull('total_x')
//            ->whereNotNull('total_y')
//            ->where('total_x', '<', 101)
//            ->count(), $resultN
//        );
//        dd($empiricalFunctionArray);

//        $yMin = $usersSortedByY->first();
//        $yMax = $usersSortedByY->last();
//        $n = 1 + 3.22 * (log($totalUsers) / log(10));
//        $resultN = ceil($n);
//        $resultN = 11;
//        $h = ($yMax->first()->total_y - $yMin->first()->total_y) / $resultN;
//        $h = ($report->y->max_value - $report->y->min_value) / $resultN;
//        $h = ($report->y->sample_size) / $report->y->intervals_number;
//        $h = $report->y->interval_value;
//        $leftSpacing = $yMin->first()->total_y;
//        $rightSpacing = $leftSpacing + $h;
//        $intervals2 = [];
//        for ($i = 0; $i < $resultN; $i++) {
//            $interval = [];
//            $n_i = $users->whereBetween('total_y', [$i === 0 ? $leftSpacing : $leftSpacing + 1, $rightSpacing])->count();
//            $interval['interval'] = ($i === 0 ? '[' : '(') . $leftSpacing . '; ' . $rightSpacing . ']';
//            $interval['count'] = $n_i;
//            $interval['frequency'] = round($n_i / $totalUsers, 4);
//            $interval['middle'] = ($leftSpacing + $rightSpacing) / 2;
//
//            $leftSpacing += $h;
//            $rightSpacing += $h;
//            $intervals2[] = $interval;
//        }

//        $leftSpacing = $yMin->first()->total_y;
//        $leftSpacing = $report->y->min_value;
//        $rightSpacing = $leftSpacing + $report->y->interval_value;
//        $empiricalFunctionArrayY = [];
//        $empiricalFunctionArrayY[] = [PHP_INT_MIN, $leftSpacing];
//        for ($i = 0; $i < $report->y->intervals_number; $i++) {
//            $empiricalFunctionArrayY[] = [$leftSpacing, $rightSpacing];
//            $leftSpacing += $report->y->interval_value;
//            $rightSpacing += $report->y->interval_value;
//        }
//        $empiricalFunctionArrayY[] = [$leftSpacing, PHP_INT_MAX];
//        $empiricalFunctionArrayY = array_map(function ($intervals) use ($totalUsers, $users) {
//            $result = /*User::query()
//                    ->whereNotNull('total_x')
//                    ->whereNotNull('total_y')*/
//                    $users
//                    ->where('total_y', '<', $intervals[1])
//                    ->count() / $totalUsers;
//            return [
//                'left' => $intervals[0] === PHP_INT_MIN ? '-\infty' : $intervals[0],
//                'x' => $intervals[1] === PHP_INT_MAX ? '+\infty' : $intervals[1],
//                'y' => round($result, 4)
//            ];
//        }, $empiricalFunctionArrayY);

//        dd($intervals2);

        /*
        $expectedValue = [
            'x' => [],
            'y' => [],
        ];

        foreach (['x', 'y'] as $randomValue) {
            $oldIntervals = $intervals;
            $intervals = $randomValue === 'x' ? $intervals : $intervals2;
            $formula = [];
            foreach ($intervals as $interval) {
                $formula[] = $interval['middle'] . '\cdot' . $interval['frequency'];
            }
            $expectedValue[$randomValue]['formula'] = implode(' + ', $formula);
            $expectedValue[$randomValue]['result'] = round(collect($intervals)->map(fn ($inter) => $inter['middle'] * $inter['frequency'])->sum(), 4);

            $formula = [];
            foreach ($intervals as $interval) {
                $formula[] = $interval['middle'] . '^2 ' . '\cdot' . $interval['frequency'];
            }
            $expectedValue[$randomValue]['formula2'] = implode(' + ', $formula) . ' - (' . $expectedValue[$randomValue]['result'] . ')^2';
            $expectedValue[$randomValue]['result2'] = round(collect($intervals)->map(fn ($inter) => pow($inter['middle'], 2) * $inter['frequency'])->sum() - pow($expectedValue[$randomValue]['result'], 2), 4);

            $expectedValue[$randomValue]['formula3'] = '\sqrt{' . $expectedValue[$randomValue]['result2'] . '}';
            $expectedValue[$randomValue]['result3'] = round(sqrt($expectedValue[$randomValue]['result2']), 4);

            $expectedValue[$randomValue]['formula4'] = '\frac{' . $totalUsers . '}{' . $totalUsers . ' - 1} ' . $expectedValue[$randomValue]['result2'];
            $expectedValue[$randomValue]['result4'] = round(($totalUsers / ($totalUsers - 1)) * $expectedValue[$randomValue]['result2'], 4);

            $expectedValue[$randomValue]['formula5'] = '\sqrt{' . $expectedValue[$randomValue]['result4'] . '}';
            $expectedValue[$randomValue]['result5'] = round(sqrt($expectedValue[$randomValue]['result4']), 4);

            $formula = [];
//            foreach ($intervals as $interval) {
            for ($i = 0; $i < 4; $i++) {
                $formula[] = '(' . $intervals[$i]['middle'] . ' - ' . $expectedValue[$randomValue]['result'] . ')^3' . ' \cdot' . $intervals[$i]['frequency'];
            }
            $expectedValue[$randomValue]['formula6'] = '\frac{' . implode('+', $formula) . ' + \dots}{' . $expectedValue[$randomValue]['result5'] . '^3}';
            $expectedValue[$randomValue]['result6'] = round(collect($intervals)->map(fn ($inter) => pow($inter['middle'] - $expectedValue[$randomValue]['result'], 3) * $inter['frequency'])->sum() / pow($expectedValue[$randomValue]['result5'], 3), 4);

            $formula = [];
//            foreach ($intervals as $interval) {
                for ($i = 0; $i < 4; $i++) {
                $formula[] = '(' . $intervals[$i]['middle'] . ' - ' . $expectedValue[$randomValue]['result'] . ')^4' . ' \cdot' . $intervals[$i]['frequency'];
            }
            $expectedValue[$randomValue]['formula7'] = '\frac{' . implode('+', $formula) . ' + \dots}{' . $expectedValue[$randomValue]['result5'] . '^4} - 3';
            $expectedValue[$randomValue]['result7'] = round(collect($intervals)->map(fn ($inter) => pow($inter['middle'] - $expectedValue[$randomValue]['result'], 4) * $inter['frequency'])->sum() / pow($expectedValue[$randomValue]['result5'], 4) - 3, 4);
//            dd(collect($intervals)->sum('frequency'));

            $intervals = $oldIntervals;
        }
        */

//        $h = 10;
//        $leftSpacing = $xMin->first()->total_x;
//        $leftSpacing = $report->x->min_value;
//        $rightSpacing = $leftSpacing + $report->x->interval_value;
//        $x_B = $report->x->M;
//        $x_B = $expectedValue['x']['result'];

//        $bigTable = ['x' => [], 'y' => []];
//        $t = [];
//        for ($i = 0; $i < $report->x->intervals_number; $i++) {
//            $resultSubTable = [];
//            $resultSubTable['id'] = $i + 1;
//            $resultSubTable['interval'] = $leftSpacing . ' ― ' . $rightSpacing;
//            $resultSubTable['ni'] =/* User::query()
//                ->whereNotNull('total_x')
//                ->whereNotNull('total_y')*/
//                $users
//                ->whereBetween('total_x', [$leftSpacing + ($i === 0 ? 0 : 1), $rightSpacing])
//                ->count();
//            $resultSubTable['pi'] = round(exp(-($leftSpacing) / ($x_B)) - exp(-($rightSpacing) / ($x_B)), 4);
//            $resultSubTable['n`i'] = round($report->total * $resultSubTable['pi']);
//            $resultSubTable['ni - n`i'] = $resultSubTable['ni'] - $resultSubTable['n`i'];
//            $resultSubTable['(ni - n`i)^2'] = pow($resultSubTable['ni - n`i'],2);
//            $resultSubTable['(ni - n`i)^2/n`i'] = round($resultSubTable['(ni - n`i)^2'] / $resultSubTable['n`i'], 4);
//
//            $leftSpacing += $report->x->interval_value;
//            $rightSpacing += $report->x->interval_value;
//            $t[] = $resultSubTable;
//        }
//        $bigTable['x'] = $t;
//        $bigTable['x_n'] = collect($t)->sum('ni');
//        $bigTable['x_chi'] = collect($t)->sum('(ni - n`i)^2/n`i');
        /*
                $double = [];
        //        $doubleUsers = User::query()
        //            ->whereNotNull('total_x')
        //            ->whereNotNull('total_y');
                $groupX = User::query()
                    ->whereNotNull('total_x')
                    ->whereNotNull('total_y')
                    ->get()
                    ->groupBy('total_x')
                    ->sortKeys();
                $groupY = User::query()
                    ->whereNotNull('total_x')
                    ->whereNotNull('total_y')
                    ->get()
                    ->groupBy('total_y')
                    ->sortKeys();


                $double[] = ['X|Y', ...$groupY->keys()->map('strval')];
                foreach ($groupX as $total_x => $usersX) {
                    $sResult = [];
                    foreach ($groupY as $total_y => $usersY) {
                        $resS = User::query()
                            ->where('total_x', $total_x)
                            ->where('total_y', $total_y)
                            ->count();
                        $sResult[] = $resS;
                    }
                    $double[] = [strval($total_x), ...$sResult];
                }

                $graphic = [];
                $sResult = [];
                foreach ($groupY as $total_y => $usersX) {
        //            foreach ($groupY as $total_y => $usersY) {
                        $sResult[] = User::query()
                            ->where('total_y', $total_y)
                            ->whereNotNull('total_x')
                            ->count();
        //                $sResult[] = $resS;
        //            }
        //            $double[] = [strval($total_x), ...$sResult];
                }
                $double[] = ['$n_y$', ...$sResult];

                $sResult = [];
                foreach ($groupY as $total_y => $usersX) {
                    $sResult2 = [];
                    foreach ($groupX as $total_x => $usersY) {
                        $resS = User::query()
                            ->where('total_x', $total_x)
                            ->where('total_y', $total_y)
                            ->count();
                        $sResult2[] = $resS * $total_x;
                    }
                    $c = User::query()
                        ->where('total_y', $total_y)
                        ->whereNotNull('total_x')
                        ->count();
                    $sResult[] = round(array_sum($sResult2) / $c, 0);
                    $graphic[] = ['x' => round(array_sum($sResult2) / $c, 2), 'y' => $total_y];
                }
                $double[] = ['$\overline{x}_{y=y_i}$', ...$sResult];

                $XY = [];
                $XY_formula = [];
                $counter = 0;
                foreach ($groupX as $total_x => $_) {
        //            $sResult = [];
                    foreach ($groupY as $total_y => $_) {
                        $resS = User::query()
                            ->where('total_x', $total_x)
                            ->where('total_y', $total_y)
                            ->count();
                        $XY[] = $resS * $total_x * $total_y;
                        if ($counter < 10) {
                            $XY_formula[] = $resS . '\cdot' .  $total_x . '\cdot' . $total_y;
                        }
                        $counter++;
                    }
        //            $double[] = [strval($total_x), ...$sResult];
                }
                $XY = array_sum($XY) / $totalUsers;
                $XY_formula = '(' . implode(' + ', $XY_formula) . ' + \dots) \cdot \frac{1}{' . $totalUsers . '}';
                $KXY = round($XY - ($expectedValue['x']['result'] * $expectedValue['y']['result']), 4);
                $rxy = round($KXY / ($expectedValue['x']['result5'] * $expectedValue['y']['result5']), 4);
                $rxy_formula = '\frac{' . $KXY . '}{' . $expectedValue['x']['result5'] . ' \cdot ' . $expectedValue['y']['result5'] . '}';
                */

//        $doubleXY = [
//            'x' => [
//                5 => [0, 10],
//                15 => [11, 20],
//                25 => [21, 30],
//                35 => [31, 40],
//                45 => [41, 50],
//                55 => [51, 60],
//                65 => [61, 70],
//                75 => [71, 80],
//                85 => [81, 90],
//                95 => [91, 100],
//            ],
//            'y' => [
//                2 => [0, 4],
//                6 => [5, 8],
//                10 => [9, 12],
//                14 => [13, 16],
//                18 => [17, 20],
//                22 => [21, 24],
//                26 => [25, 28],
//                30 => [29, 32],
//                34 => [33, 36],
//                38 => [37, 40],
//                42 => [41, 44],
//            ],
//            'values' => [],
//            'nx' => [],
//            'intermediate' => [],
//            'yx' => [],
//            'points' => [],
//            'XY' => [],
//            '$XY' => []
//        ];
//        $i = 0;
//        foreach ($doubleXY['x'] as $total_x => $x_between) {
//            foreach ($doubleXY['y'] as $total_y => $y_between) {
//                $countUsers = /*User::query()*/
//                    $users
//                    ->whereBetween('total_x', $x_between)
//                    ->whereBetween('total_y', $y_between)
//                    ->count();
//                $doubleXY['values'][$total_x . ' ' . $total_y] = $countUsers;
//                $doubleXY['intermediate'][] = $countUsers * $total_y;
//                $doubleXY['$intermediate'][] = $countUsers . '\cdot' . $total_y;
//                $doubleXY['XY'][] = $total_x * $total_y * $countUsers;
//                if ($i < 8) {
//                    $doubleXY['$XY'][] = $total_x . '\cdot' . $total_y . '\cdot' . $countUsers;
//                }
//                $i++;
//            }
//            $nx = /*User::query()
//                ->whereNotNull('total_y')*/
//                $users
//                ->whereBetween('total_x', $x_between)
//                ->count();
//            $doubleXY['nx'][] = $nx;
//            $doubleXY['yx'][] = round((array_sum($doubleXY['intermediate'])) / $nx, 4);
//            $doubleXY['$yx'][] = ['key' => $total_x, 'value' => '(' . implode('+', $doubleXY['$intermediate']) . ') \frac{1}{' . $nx . '}'];
//            $doubleXY['points'][] = ['x' => $total_x, 'y' => end($doubleXY['yx'])];
//            $doubleXY['intermediate'] = [];
//            $doubleXY['$intermediate'] = [];
//        }
//        $doubleXY['XY'] = round(array_sum($doubleXY['XY']) / $report->total, 4);
//        $doubleXY['$XY'] = '(' . implode('+', $doubleXY['$XY']) . ' + \dots) \frac{1}{' . $report->total . '}';
//        $doubleXY['KXY'] = round($doubleXY['XY'] - $report->x->M * $report->y->M, 4);
//        $doubleXY['rxy'] = round($doubleXY['KXY'] / ($report->x->S * $report->y->S), 4);
//        dd($doubleXY, array_sum($doubleXY['values']));

        return view('report', compact([
            'users',
//            'totalUsers',
            'chunkSize',
//            'usersSortedByX',
//            'usersSortedByY',
//            'intervals',
//            'intervals2',
//            'expectedValue',
//            'empiricalFunctionArray',
//            'empiricalFunctionArrayY',
//            'bigTable',
//            'double',
//            'graphic',
//            'XY',
//            'XY_formula',
//            'KXY',
//            'rxy',
//            'rxy_formula',
//            'doubleXY',
            'report',
        ]));
    }
}
