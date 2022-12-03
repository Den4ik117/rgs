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

//        dd($usersSortedByX->toArray());

        return view('report', compact(['users', 'totalUsers', 'chunkSize', 'usersSortedByX']));
    }
}
