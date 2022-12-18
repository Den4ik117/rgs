<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleRequest;
use App\Models\Report\UsersReport;
use App\Models\Sample;
use App\Models\User;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Sample::class, 'sample');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return to_route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('samples.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SampleRequest $request)
    {
        $request->checkMaxSamples();

        $sample = Sample::query()->create([
            'user_id' => auth()->id(),
            'auto_x_intervals' => true,
            'auto_y_intervals' => true,
            'is_public' => false,
            ...$request->only('name', 'chunk', 'x_intervals', 'y_intervals'),
        ]);

        $sample->values()->createMany($request->input('samples_array'));

        return to_route('dashboard')->with('success', __('Samples successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {
        $users = $sample
            ->values()
            ->get()
            ->shuffle();

        $chunkSize = $sample->chunk;

        $x_intervals = $sample->x_intervals;
        if ($sample->auto_x_intervals) {
            $x_intervals = ceil(1 + 3.22 * log($users->count(), 10));
        }

        $y_intervals = $sample->y_intervals;
        if ($sample->auto_y_intervals) {
            $y_intervals = ceil(1 + 3.22 * log($users->count(), 10));
        }

        $report = new UsersReport($users, $x_intervals, $y_intervals);

        $user = auth()->user();

        return view('samples.show', compact(['users', 'chunkSize', 'report', 'user', 'sample']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function edit(Sample $sample)
    {
        return view('samples.edit', compact(['sample']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function update(SampleRequest $request, Sample $sample)
    {
        $sample->update([
            'auto_x_intervals' => true,
            'auto_y_intervals' => true,
            'is_public' => false,
            ...$request->only('name', 'chunk', 'x_intervals', 'y_intervals'),
        ]);

        $sample->values->toQuery()->delete();
        $sample->values()->createMany($request->input('samples_array'));

        return to_route('samples.edit', $sample->id)->with('success', __('Samples successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        $sample->delete();

        return to_route('dashboard')->with('success', 'Вы успешно удалили сэмпл.');
    }
}
