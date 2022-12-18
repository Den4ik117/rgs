<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $samples = $request->user()->samples;
        $another_samples = Sample::query()
            ->with(['values'])
//            ->whereHas('values', function (Builder $query) {
//                $query->orderBy('')
//            });
//            ->where('user_id', '!=', auth()->id())
//            ->where('is_public', true)
            ->get()
            ->sortBy(fn (Sample $sample) => $sample->values->count())
            ->reverse()
            ->take(50);

        return view('dashboard', compact(['samples', 'another_samples']));
    }
}
