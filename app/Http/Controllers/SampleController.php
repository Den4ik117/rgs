<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleRequest;
use App\Models\Report\UsersReport;
use App\Models\Sample;
use App\Models\User;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        $validated = $request->validate([
//            'name' => 'required|string|max:255',
//            'samples' => 'required|json',
//            'chunk' => 'required|integer|min:1|max:20',
//            'x_intervals' => 'required|integer|min:1|max:30',
//            'y_intervals' => 'required|integer|min:1|max:30',
//        ]);
//        dd($request->validated());

        $sample = Sample::query()->create([
            'user_id' => auth()->id(),
            ...$request->only('name', 'chunk', 'x_intervals', 'y_intervals'),
//            'name' => $request->validated()['name'],
//            'chunk' => $request->validated()['chunk'],
//            'x_intervals' => $request->validated()['x_intervals'],
//            'y_intervals' => $request->validated()['y_intervals'],
        ]);

        $sample->values()->createMany($request->input('samples_array'));

//        dd($sample, $sample->values);

        return to_route('dashboard')->with('success', __('Samples successfully created.'));

//        $sam
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
//            ->whereNotNull('x')
//            ->whereNotNull('y')
            ->get()
            ->shuffle();

//        dd($users);

        $chunkSize = $sample->chunk;

        $report = new UsersReport($users, $sample->x_intervals, $sample->y_intervals);

        $user = auth()->user();

        return view('samples.show', compact(['users', 'chunkSize', 'report', 'user']));
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
        $sample->update($request->only('name', 'chunk', 'x_intervals', 'y_intervals'));

        $sample->values->toQuery()->delete();
        $sample->values()->createMany($request->input('samples_array'));
//        foreach ($request->input('samples_array') as $value) {
//            if ($sample->values()->where('x', $value['x'])->where('y', $value['y'])->count() === 0) {
//                $sample->values()->create($value);
//            }
//        }
//        $sample->values()->man
//        $sample->values()->createMany($request->input('samples_array'));

//        dd($sample, $sample->values);

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
