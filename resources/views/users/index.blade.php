<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($users->isNotEmpty())
                        <p class="font-bold text-xl">Users:</p>

                        <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mt-4">
                            @foreach ($users as $user)

                                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
{{--                                    <a href="{{ route('samples.show', $user->id) }}">--}}
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $user->full_name }}</h5>
{{--                                    </a>--}}
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Samples number: {{ $user->samples()->count() }}</p>
                                    <div class="flex gap-2 flex-wrap">
{{--                                        <a href="{{ route('samples.show', $user->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">--}}
{{--                                            Посмотреть отчёт--}}
{{--                                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{ route('samples.edit', $user->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">--}}
{{--                                            Редактировать сэмп--}}
{{--                                            <svg class="w-4 h-4 ml-2 -mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>--}}
{{--                                        </a>--}}
                                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <div class="flex flex-col gap-2">
                                                @foreach(\App\Enums\Role::ROLES as $role)
                                                    <x-input-label class="flex items-center gap-2 cursor-pointer select-none">
                                                        <input type="radio" name="role" value="{{ $role->value }}" @checked($user->role === $role->value)>
                                                        {{ $role->name }}
                                                    </x-input-label>
                                                @endforeach
                                            </div>

                                            <button class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">
                                                Сохранить
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
