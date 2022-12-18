<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $samples = $request->user()->samples;
        $another_samples = Sample::query()
            ->where('user_id', '!=', auth()->id())
            ->where('is_public', true)
            ->get();

        return view('dashboard', compact(['samples', 'another_samples']));
    }
}
