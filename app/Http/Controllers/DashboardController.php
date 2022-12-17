<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $samples = $request->user()->samples;

        return view('dashboard', compact(['samples']));
    }
}
