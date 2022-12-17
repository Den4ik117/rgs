<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create sample') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Create sample with random values X and Y.") }}
        </p>
    </header>

{{--    <form id="send-verification" method="post" action="{{ route('verification.send') }}">--}}
{{--        @csrf--}}
{{--    </form>--}}

    <form id="sampleForm" method="post" action="{{ route('samples.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="chunk" :value="__('Название выборки')" />
            <x-text-input id="chunk" name="name" type="text" class="mt-1 block w-full" :value="old('name', '')" required autofocus autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <div class="sample" data-data="{{ old('samples', '[]') }}"></div>
            <x-input-error class="mt-2" :messages="$errors->first('samples')" />
            <x-input-error class="mt-2" :messages="$errors->first('samples_array')" />
            <x-input-error class="mt-2" :messages="$errors->first('samples_array.*.x')" />
            <x-input-error class="mt-2" :messages="$errors->first('samples_array.*.y')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Сколько колонок с парами будет в начальной таблице')" />
            <x-text-input id="name" name="chunk" type="number" min="1" max="20" step="1" class="mt-1 block w-full" :value="old('chunk', 4)" required autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('chunk')" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="x_intervals" :value="__('Сколько интервалов у X')" />
                <x-text-input id="x_intervals" name="x_intervals" type="number" min="1" max="30" step="1" class="mt-1 block w-full" :value="old('x_intervals', 10)" required autocomplete="off" />
                <x-input-error class="mt-2" :messages="$errors->get('x_intervals')" />
            </div>
            <div>
                <x-input-label for="y_intervals" :value="__('Сколько интервалов у Y')" />
                <x-text-input id="y_intervals" name="y_intervals" type="number" min="1" max="30" step="1" class="mt-1 block w-full" :value="old('y_intervals', 10)" required autocomplete="off" />
                <x-input-error class="mt-2" :messages="$errors->get('y_intervals')" />
            </div>
        </div>

{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('email')" />--}}

{{--            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())--}}
{{--                <div>--}}
{{--                    <p class="text-sm mt-2 text-gray-800">--}}
{{--                        {{ __('Your email address is unverified.') }}--}}

{{--                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--                            {{ __('Click here to re-send the verification email.') }}--}}
{{--                        </button>--}}
{{--                    </p>--}}

{{--                    @if (session('status') === 'verification-link-sent')--}}
{{--                        <p class="mt-2 font-medium text-sm text-green-600">--}}
{{--                            {{ __('A new verification link has been sent to your email address.') }}--}}
{{--                        </p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
            <x-input-error class="mt-2" :messages="$errors->get('max_samples')" />

            @if (session('status') === 'sample-created')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
