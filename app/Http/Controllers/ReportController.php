<?php

namespace App\Http\Controllers;

use App\Models\Report\Report;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->whereNotNull('total_x')
            ->whereNotNull('total_y')
            ->get()
            ->shuffle();

        $chunkSize = 9;

        $report = new Report($users);

        return view('report', compact(['users', 'chunkSize', 'report']));
    }
}
