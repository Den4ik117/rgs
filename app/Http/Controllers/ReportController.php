<?php

namespace App\Http\Controllers;

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

        $totalUsers = $users->count();

        $chunkSize = 6;

        $usersSortedByX = $users->groupBy('total_x')->sortKeys()->values();
        $usersSortedByY = $users->groupBy('total_y')->sortKeys()->values();

        $xMin = $usersSortedByX->first();
        $xMax = $usersSortedByX->last();
        $n = 1 + 3.22 * (log($totalUsers) / log(10));
        $resultN = ceil($n);
        $h = ($xMax->first()->total_x - $xMin->first()->total_x) / $resultN;
        $leftSpacing = $xMin->first()->total_x;
        $rightSpacing = $leftSpacing + $h;
        $intervals = [];
        for ($i = 0; $i < $resultN; $i++) {
            $interval = [];
            $n_i = $users->whereBetween('total_x', [$i === 0 ? $leftSpacing : $leftSpacing + 1, $rightSpacing])->count();
            $interval['interval'] = ($i === 0 ? '[' : '(') . $leftSpacing . '; ' . $rightSpacing . ']';
            $interval['count'] = $n_i;
            $interval['frequency'] = round($n_i / $totalUsers, 4);
            $interval['middle'] = ($leftSpacing + $rightSpacing) / 2;

            $leftSpacing += $h;
            $rightSpacing += $h;
            $intervals[] = $interval;
        }

        $yMin = $usersSortedByY->first();
        $yMax = $usersSortedByY->last();
        $n = 1 + 3.22 * (log($totalUsers) / log(10));
        $resultN = ceil($n);
        $h = ($yMax->first()->total_y - $yMin->first()->total_y) / $resultN;
        $leftSpacing = $yMin->first()->total_y;
        $rightSpacing = $leftSpacing + $h;
        $intervals2 = [];
        for ($i = 0; $i < $resultN; $i++) {
            $interval = [];
            $n_i = $users->whereBetween('total_y', [$i === 0 ? $leftSpacing : $leftSpacing + 1, $rightSpacing])->count();
            $interval['interval'] = ($i === 0 ? '[' : '(') . $leftSpacing . '; ' . $rightSpacing . ']';
            $interval['count'] = $n_i;
            $interval['frequency'] = round($n_i / $totalUsers, 4);
            $interval['middle'] = ($leftSpacing + $rightSpacing) / 2;

            $leftSpacing += $h;
            $rightSpacing += $h;
            $intervals2[] = $interval;
        }

//        dd($intervals2);

        $expectedValue = [
            'x' => [],
            'y' => [],
        ];

        foreach (['x', 'y'] as $randomValue) {
            $intervals = $randomValue === 'x' ? $intervals : $intervals2;
            $formula = [];
            foreach ($intervals as $interval) {
                $formula[] = $interval['middle'] . '\cdot' . $interval['frequency'];
            }
            $expectedValue[$randomValue]['formula'] = implode(' + ', $formula);
            $expectedValue[$randomValue]['result'] = collect($intervals)->map(fn ($inter) => $inter['middle'] * $inter['frequency'])->sum();

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
        }
//        dd($expectedValue);

        return view('report', compact(['users', 'totalUsers', 'chunkSize', 'usersSortedByX', 'usersSortedByY', 'intervals', 'intervals2', 'expectedValue']));
    }
}
