@php
/**
 * @var \Illuminate\Support\Collection $users
 * @var \Illuminate\Support\Collection $usersSortedByX
 * @var \Illuminate\Support\Collection $usersSortedByY
 */
@endphp
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Расчётно-графическая работа по математической статистике | Zagvozdin Denis</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Round" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="antialiased bg-white p-4">
<article>
    <div class="text-center flex flex-col justify-between" style="page-break-after: always; height: 297mm;">
        <div>
            <p>Министерство образования и науки Российской Федерации</p>
            <p>Уральский федеральный университет</p>
            <p>имени первого Президента России Б.Н. Ельцина</p>
        </div>
        <div class="flex flex-col">
            <h1 class="text-2xl mb-8 font-bold">Расчётно-графическая работа<br>по математической статистике</h1>
            <div class="mt-16 text-left ml-auto">
                <p>Выполнил: <strong class="font-semibold">Загвоздин Денис Сергеевич</strong></p>
                <p>Группа: <strong class="font-semibold">РИ-210911</strong></p>
                <p>Преподаватель: <strong class="font-semibold">Поторочина Ксения Сергеевна</strong></p>
                <p>Дата: <strong class="font-semibold">{{ now()->format('d.m.Y') }}</strong></p>
                {{--            <p>Оценка: ___</p>--}}
            </div>
        </div>
        <div>
            <p>Екатеринбург</p>
            <p>УрФУ</p>
            <p>2022</p>
        </div>
    </div>

    <div class="flex flex-col" style="page-break-after: always; height: 297mm;">
        <h2 class="text-xl font-semibold mb-6 text-center">Список основных обозначений</h2>
        <p class="text-base mb-4 flex flex-col gap-2">
            <span>$ N - \mathrm{число \, единиц \, совокупности} $</span>
            <span>$ n - \mathrm{число \, групп \, (интервалов)} $</span>
            <span>$ x_{min}, y_{min} - \mathrm{нижняя \, граница \, интервала} $</span>
            <span>$ x_{max}, y_{max} - \mathrm{верхняя \, граница \, интервала} $</span>
            <span>$ h - \mathrm{величина \, интервала} $</span>
            <span>$ \overline{x}_в, \overline{y}_в - \mathrm{выборочное \, среднее} $</span>
            <span>$ \overline{D}_в - \mathrm{средняя \, выборочная \, дисперсия} $</span>
            <span>$ \sigma_в - \mathrm{выборочное \, среднее \, квадратическое \, отклонение} $</span>
            <span>$ S^2 - \mathrm{несмещённая \, состоятельная \, оценка \, генеральной \, дисперсии} $</span>
            <span>$ S - \mathrm{исправленное \, выборочное \, среднее \, квадратическое \, отклонение} $</span>
        </p>
    </div>

    <div class="flex flex-col" style="page-break-after: always; height: 297mm;">
        <h2 class="text-xl font-semibold mb-6 text-center">Введение</h2>
        <p class="text-base mb-4">
            Исследуем корреляцию между оценками студентов в смежных предметах: основы веб-технологий и технологии программирования.
            Будем брать случайного студента и смотреть его итоговый балл в обеих дисциплинах.
            $ X $ - оценка студента по предмету «Основы веб-технологий».
            $ Y $ - оценка студента по предмету «Технологии программирования».
        </p>
        <p class="text-base mb-4">
            Вариации дискретные, так как имеют изолированные значения: $ X = \{0, 1, 2, \dots, 100\}; \; Y = \{0, 1, 2, \dots, 43\} $.
        </p>
        <p class="text-base mb-4">
            Материал взят из открытых ведомостей, которые регулярно обновляется, поэтому материал актуален на момент написания работы ― {{ now()->format('d.m.Y') }}
        </p>
        <p class="text-base mb-4">
            Цель: исследовать корреляцию между оценками студентов в смежных предметах.
        </p>
        <p class="text-base mb-4">
            Способ отбора данных: простой случайный отбор.
        </p>
        <p class="text-base mb-2">
            Ссылки:
        </p>
        <ul class="text-base mb-4 list-inside flex flex-col gap-1">
            <li><a class="text-indigo-800 hover:text-indigo-900 underline" href="https://laravel.com/">PHP фреймворк, который лёг в основу генерации этого отчёта</a></li>
            <li><a class="text-indigo-800 hover:text-indigo-900 underline" href="https://www.mathjax.org/">JS библиотека, с помощью которой отображаются LaTeX формулы</a></li>
            <li><a class="text-indigo-800 hover:text-indigo-900 underline" href="https://tailwindcss.com/">CSS фреймворк, отвечающий за стилизацию страниц</a></li>
            <li><a class="text-indigo-800 hover:text-indigo-900 underline" href="https://en.wikibooks.org/wiki/LaTeX/Mathematics">Руководство по LaTeX, которая позволяет создавать сложные математические формулы</a></li>
            <li><a class="text-indigo-800 hover:text-indigo-900 underline" href="https://docs.google.com/spreadsheets/d/1TxpEzQQ-ObY7dnmQjaghiWfDDdwoflRO05VugkxgZYY/edit?usp=sharing">Ведомость по предмету «Основы веб-технологий»</a></li>
            <li><a class="text-indigo-800 hover:text-indigo-900 underline" href="https://docs.google.com/spreadsheets/d/17ocFGE22HsBG8AK1DLlnHBl4MaTKWsPjeZ7M3ywS_n4/edit?usp=sharing">Ведомость по предмету «Технологии программирования»</a></li>
            <li><a class="text-indigo-800 hover:text-indigo-900 underline" href="https://github.com/Den4ik117/rgs">Исходный код программы</a></li>
        </ul>
    </div>

    <table class="w-full mb-8" style="page-break-after: always;">
        <thead>
        <tr>
            @for($i = 0; $i < $chunkSize; $i++)
                <th class="border px-6 py-4 text-center border-l-2 border-t-2 border-b-2 border-gray-300">$ X $</th>
                <th class="border px-6 py-4 text-center border-r-2 border-t-2 border-b-2 border-gray-300">$ Y $</th>
            @endfor
        </tr>
        </thead>
        <tbody>
        @foreach($users->chunk($chunkSize) as $chunk)
            <tr>
                @foreach($chunk as $user)
                    <td class="border px-6 py-4 text-center border-l-2 border-gray-300">{{ $user->total_x }}</td>
                    <td class="border px-6 py-4 text-center border-r-2 border-gray-300">{{ $user->total_y }}</td>
                @endforeach
                @if ($loop->last)
                    @for ($i = 0; $i < ($chunkSize - $totalUsers % $chunkSize); $i++)
                        <td class="border px-6 py-4 text-center border-l-2 border-gray-300"></td>
                        <td class="border px-6 py-4 text-center border-r-2 border-gray-300"></td>
                    @endfor
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="border px-6 py-4 text-center border-x-2 border-y-2 border-gray-300" colspan="100%">
                $ N = {{ $totalUsers }} $
            </td>
        </tr>
        </tfoot>
    </table>

    <h2 class="text-xl mb-6">Первичная обработка результатов эксперимента</h2>

    <h3 class="text-lg mb-4">Обработка одномерной СВ $ X $.</h3>

    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ X = \{ x_i \} $</span>
        @php
            $xMin = $usersSortedByX->shift();
            $xMax = $usersSortedByX->pop();
            $n = 1 + 3.22 * (log($totalUsers) / log(10));
//            $resultN = (floor($n) % 2 === 0) ? ceil($n) : floor($n);
            $resultN = ceil($n);
            $h = ($xMax->first()->total_x - $xMin->first()->total_x) / $resultN;
        @endphp
        <span>$ x_{min} = {{ $xMin->first()->total_x }} \, ({{ $usersSortedByX->shift()->first()->total_x }}); \; m = {{ $xMin->count() }} $</span>
        <span>$ x_{max} = {{ $xMax->first()->total_x }} \, ({{ $usersSortedByX->pop()->first()->total_x }}); \; m = {{ $xMax->count() }} $</span>
        <span>$ x_{max} - x_{min} = {{ $xMax->first()->total_x }} - {{ $xMin->first()->total_x }} = {{ $xMax->first()->total_x - $xMin->first()->total_x }} - \mathrm{размах \, выборки} $</span>
        <span>$ n = 1 + 3.22 \lg N = 1 + 3.22 \frac{\ln N}{\ln 10} = 1 + 3.22 \frac{\ln {{ $totalUsers }}}{\ln 10} = {{ $n }} \approx {{ $resultN }} - \mathrm{число \, интервалов} $</span>
        <span>$ h = \frac{x_{max} - x_{min}}{n} = \frac{ {{ $xMax->first()->total_x }} - {{ $xMin->first()->total_x }} }{ {{ $resultN }} } = {{ $h }} - \mathrm{число \, групп \, (интервалов)} $</span>
    </p>

    <h3 class="text-lg mb-4">Построим статистический ряд.</h3>

    <table class="w-full mb-4">
        <thead>
        <tr>
            <th class="border px-6 py-4 text-center">$ (x_{i - 1}; x_i] $</th>
            <th class="border px-6 py-4 text-center">$ n_i $</th>
            <th class="border px-6 py-4 text-center">$ \omega_i = \frac{n_i}{N}$</th>
            <th class="border px-6 py-4 text-center">$ x_{i \, сер} $</th>
        </tr>
        </thead>
        <tbody>
            @foreach($intervals as $interval)
                <tr>
                    <td class="border px-6 py-4 text-center">$ {{ $interval['interval'] }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval['count'] }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval['frequency'] }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval['middle'] }} $</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Гистограмма частот</h3>

    <div class="chart_div" style="height: 300px; max-width: 210mm;" data-data="{{ collect($intervals)->pluck('frequency')->toJson() }}" data-middle="{{ collect($intervals)->pluck('middle')->toJson() }}" data-labels="[0, 100, 5]"></div>

    <h3 class="text-lg mb-4">Найдём числовые характеристики</h3>
    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ \overline{x}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals) }} } {x_i \omega_i} = {{ $expectedValue['x']['formula'] }} = {{ $expectedValue['x']['result'] }} $</span>
        <span>$ \overline{D}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals) }} } {x^2_i \omega_i} - (\overline{x}_в)^2 = {{ $expectedValue['x']['formula2'] }} = {{ $expectedValue['x']['result2'] }} $</span>
        <span>$ \sigma_в = \sqrt{\overline{D}_в} = {{ $expectedValue['x']['formula3'] }} = {{ $expectedValue['x']['result3'] }} $</span>
        <span>$ S^2 = \frac{N}{N - 1} \overline{D}_в = {{ $expectedValue['x']['formula4'] }} = {{ $expectedValue['x']['result4'] }} $</span>
        <span>$ S = \sqrt{S^2} = {{ $expectedValue['x']['formula5'] }} = {{ $expectedValue['x']['result5'] }} $</span>
    </p>



    <h3 class="text-lg mb-4">Обработка одномерной СВ $ Y $.</h3>

    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ Y = \{ y_i \} $</span>
        @php
            $yMin = $usersSortedByY->shift();
            $yMax = $usersSortedByY->pop();
            $n = 1 + 3.22 * (log($totalUsers) / log(10));
//            $resultN = (floor($n) % 2 === 0) ? ceil($n) : floor($n);
            $resultN = ceil($n);
            $h = ($yMax->first()->total_y - $yMin->first()->total_y) / $resultN;
        @endphp
        <span>$ y_{min} = {{ $yMin->first()->total_y }} \, ({{ $usersSortedByY->shift()->first()->total_y }}); \; m = {{ $yMin->count() }} $</span>
        <span>$ y_{max} = {{ $yMax->first()->total_y }} \, ({{ $usersSortedByY->pop()->first()->total_y }}); \; m = {{ $yMax->count() }} $</span>
        <span>$ y_{max} - y_{min} = {{ $yMax->first()->total_y }} - {{ $yMin->first()->total_y }} = {{ $yMax->first()->total_y - $yMin->first()->total_y }} - \mathrm{размах \, выборки} $</span>
        <span>$ n = 1 + 3.22 \lg N = 1 + 3.22 \frac{\ln N}{\ln 10} = 1 + 3.22 \frac{\ln {{ $totalUsers }}}{\ln 10} = {{ $n }} \approx {{ $resultN }} - \mathrm{число \, интервалов} $</span>
        <span>$ h = \frac{y_{max} - y_{min}}{n} = \frac{ {{ $yMax->first()->total_y }} - {{ $yMin->first()->total_y }} }{ {{ $resultN }} } = {{ $h }} - \mathrm{число \, групп \, (интервалов)} $</span>
    </p>

    <h3 class="text-lg mb-4">Построим статистический ряд.</h3>

    <table class="w-full mb-4">
        <thead>
        <tr>
            <th class="border px-6 py-4 text-center">$ (y_{i - 1}; y_i] $</th>
            <th class="border px-6 py-4 text-center">$ n_i $</th>
            <th class="border px-6 py-4 text-center">$ \omega_i = \frac{n_i}{N}$</th>
            <th class="border px-6 py-4 text-center">$ y_{i \, сер} $</th>
        </tr>
        </thead>
        <tbody>
        @foreach($intervals2 as $interval)
            <tr>
                <td class="border px-6 py-4 text-center">$ {{ $interval['interval'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['count'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['frequency'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['middle'] }} $</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Гистограмма частот</h3>

    <div class="chart_div_2" style="height: 300px; max-width: 210mm;" data-data="{{ collect($intervals2)->pluck('frequency')->toJson() }}" data-middle="{{ collect($intervals2)->pluck('middle')->toJson() }}" data-labels="[0, 44, 4.4]"></div>

    <h3 class="text-lg mb-4">Найдём числовые характеристики</h3>
    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ \overline{y}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {y_i \omega_i} = {{ $expectedValue['y']['formula'] }} = {{ $expectedValue['y']['result'] }} $</span>
        <span>$ \overline{D}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {y^2_i \omega_i} - (\overline{y}_в)^2 = {{ $expectedValue['y']['formula2'] }} = {{ $expectedValue['y']['result2'] }} $</span>
        <span>$ \sigma_в = \sqrt{\overline{D}_в} = {{ $expectedValue['y']['formula3'] }} = {{ $expectedValue['y']['result3'] }} $</span>
        <span>$ S^2 = \frac{N}{N - 1} \overline{D}_в = {{ $expectedValue['y']['formula4'] }} = {{ $expectedValue['y']['result4'] }} $</span>
        <span>$ S = \sqrt{S^2} = {{ $expectedValue['y']['formula5'] }} = {{ $expectedValue['y']['result5'] }} $</span>
    </p>

{{--    <div class="chart_div"></div>--}}
{{--    {{ dd($intervals) }}--}}

</article>

<script>
    MathJax = {
        tex: {
            inlineMath: [['$', '$'], ['\\(', '\\)']]
        }
    };
</script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@include('metricts')
</body>
</html>
