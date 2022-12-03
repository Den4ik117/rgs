<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Round" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="antialiased bg-white">
<div class="w-screen h-screen flex items-center justify-center p-4">
{{--    <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data">--}}
{{--        @csrf--}}

        <ul class="max-w-sm w-full">
            <li class="p-4 text-center text-sm text-gray-500 bg-gray-100 cursor-auto select-none border-b rounded-t-xl font-bold">
                РГС по математической статистике
            </li>
{{--            <li class="">--}}
{{--                <label for="file_1" class="block cursor-pointer px-16 py-6 text-center text-base text-indigo-500 bg-gray-100 hover:bg-gray-200 border-b font-semibold relative">--}}
{{--                    <span class="material-icons-round absolute top-1/2 -translate-y-1/2 left-3 text-3xl">upload_file</span>--}}
{{--                    Загрузить случайную величину X--}}
{{--                </label>--}}
{{--                <input class="hidden" type="file" name="file_1" id="file_1" accept="text/csv">--}}
{{--            </li>--}}
{{--            <li class="">--}}
{{--                <label for="file_2" class="block cursor-pointer px-16 py-6 text-center text-base text-indigo-500 bg-gray-100 hover:bg-gray-200 border-b font-semibold relative">--}}
{{--                    <span class="material-icons-round absolute top-1/2 -translate-y-1/2 left-3 text-3xl">cloud_upload</span>--}}
{{--                    Загрузить случайную величину Y--}}
{{--                </label>--}}
{{--                <input class="hidden" type="file" name="file_2" id="file_2" accept="text/csv">--}}
{{--            </li>--}}
            <li class="">
                <a href="{{ route('report') }}" class="block px-16 py-6 text-center text-base text-indigo-500 bg-gray-100 hover:bg-gray-200 rounded-b-xl font-semibold relative">
                    <span class="material-icons-round absolute top-1/2 -translate-y-1/2 left-3 text-3xl">description</span>
                    Посмотреть отчёт
                </a>
            </li>
        </ul>
{{--    </form>--}}
</div>
</body>
</html>
