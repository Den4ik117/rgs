<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SampleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'samples_array' => json_decode($this->input('samples', '[]'), true)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'samples' => 'required|json',
            'samples_array' => 'required|array|min:2',
            'samples_array.*.x' => 'required|integer',
            'samples_array.*.y' => 'required|integer',
            'chunk' => 'required|integer|min:1|max:20',
            'x_intervals' => 'required|integer|min:1|max:30',
            'y_intervals' => 'required|integer|min:1|max:30',
        ];
    }

    public function checkMaxSamples()
    {
        if (auth()->user()->samples()->count() >= 2) {
            throw ValidationException::withMessages([
                'max_samples' => 'Вы не можете создать больше двух сэмплов.'
            ]);
        }
    }
}
