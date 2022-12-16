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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <table class="w-full mb-8 text-xs" style="page-break-after: always;">
        <thead>
        <tr>
            @for($i = 0; $i < $chunkSize; $i++)
                <th class="border px-1 py-1 text-center border-l-2 border-t-2 border-b-2 border-gray-300">$ X $</th>
                <th class="border px-1 py-1 text-center border-r-2 border-t-2 border-b-2 border-gray-300">$ Y $</th>
            @endfor
        </tr>
        </thead>
        <tbody>
        @foreach($users->chunk($chunkSize) as $chunk)
            <tr>
                @foreach($chunk as $user)
                    <td class="border px-1 py-1 text-center border-l-2 border-gray-300">{{ $user->total_x }}</td>
                    <td class="border px-1 py-1 text-center border-r-2 border-gray-300">{{ $user->total_y }}</td>
                @endforeach
                @if ($loop->last)
                    @for ($i = 0; $i < ($chunkSize - $totalUsers % $chunkSize); $i++)
                        <td class="border px-1 py-1 text-center border-l-2 border-gray-300"></td>
                        <td class="border px-1 py-1 text-center border-r-2 border-gray-300"></td>
                    @endfor
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="border px-1 py-1 text-center border-x-2 border-y-2 border-gray-300" colspan="100%">
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

            <tr>
                <td class=""></td>
                <td class="border px-6 py-4 text-center">$ \sum{n_i} = {{ collect($intervals)->sum('count') }} $</td>
                <td class="border px-6 py-4 text-center">$ \sum{\omega_i} = {{ collect($intervals)->sum('frequency') }} $</td>
                <td class=""></td>
            </tr>
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Гистограмма и полигон частот</h3>

    <div class="chart_div" style="height: 300px; max-width: 210mm;" data-data="{{ collect($intervals)->pluck('frequency')->toJson() }}" data-middle="{{ collect($intervals)->pluck('middle')->toJson() }}" data-labels="[0, 100, 5]"></div>

    <h3 class="text-lg mb-4">Найдём числовые характеристики</h3>
    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ \overline{x}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals) }} } {x_i \omega_i} = {{ $expectedValue['x']['formula'] }} = {{ $expectedValue['x']['result'] }} $</span>
        <span>$ \overline{D}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals) }} } {x^2_i \omega_i} - (\overline{x}_в)^2 = {{ $expectedValue['x']['formula2'] }} = {{ $expectedValue['x']['result2'] }} $</span>
        <span>$ \sigma_в = \sqrt{\overline{D}_в} = {{ $expectedValue['x']['formula3'] }} = {{ $expectedValue['x']['result3'] }} $</span>
        <span>$ S^2 = \frac{N}{N - 1} \overline{D}_в = {{ $expectedValue['x']['formula4'] }} = {{ $expectedValue['x']['result4'] }} $</span>
        <span>$ S = \sqrt{S^2} = {{ $expectedValue['x']['formula5'] }} = {{ $expectedValue['x']['result5'] }} $</span>
        <span>$ A_S = \frac{\mu^3}{S^3} = \frac{\displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {(x_i - \overline{x_в})^3 \omega_i}}{S^3} = {{ $expectedValue['x']['formula6'] }} = {{ $expectedValue['x']['result6'] }} - \mathrm{коэффициент \, асимметрии} $</span>
        <span>$ E_S = \frac{\mu^4}{S^4} - 3 = \frac{\displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {(x_i - \overline{x_в})^4 \omega_i}}{S^4} - 3 = {{ $expectedValue['x']['formula7'] }} = {{ $expectedValue['x']['result7'] }} - \mathrm{коэффициент \, эксцесса}$</span>
    </p>

    <p class="text-base mb-4">
        Коэффициент асимметрии характеризует меру скошенности графика/вправо, а эксцесс ― меру его высоты.
        То, что эти коэффициенты принимают большие значения, ожидаемо.
        Из полигона частот мы уже могли сделать вывод, что распределение не является нормальным.
        Большие значения коэффициентов помогают лишний раз убедиться, что распределение отличное от нормального.
        На перёд ― для СВ $ Y $ коэффициенты тоже принимают большие значения, что позволяет сделать аналогичный вывод.
    </p>

    <h3 class="text-lg mb-4">Найдём эмпирическую функцию распределения и построим ее график.</h3>

    <table class="w-full mb-4">
        <thead>
        <tr>
            <th class="border px-6 py-4 text-center">$ (x_{i - 1}; x_i] $</th>
            <th class="border px-6 py-4 text-center">$ x $</th>
            <th class="border px-6 py-4 text-center">$ F^{\ast}(x) = W(X < x) $</th>
        </tr>
        </thead>
        <tbody>
        @foreach($empiricalFunctionArray as $interval)
            <tr>
                <td class="border px-6 py-4 text-center">$ {{ '(' . $interval['left'] . '; ' . $interval['x'] . ($loop->last ? ')' : ']') }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['x'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['y'] }} $</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Кумулята:</h3>

    <div class="chart_div_3" data-data="{{ collect($empiricalFunctionArray)->toJson() }}"></div>

    <h3 class="text-lg mb-4">Проверка критерия Пирсона</h3>

    <p class="text-base mb-4">
        Установим уровень значимости $ \alpha $, при котором распределение для выборки согласуется с <strong>показательным законом</strong> распределения по критерию Пирсона ($ \chi^2 $).
        Возьмём готовые формулы, которые мы получили на практиках.
        Функция плотности для показательного распределения:
    </p>

    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$$
f(x) =
  \begin{cases}
    0       & \quad x < 0\\
    \lambda e^{-\lambda x}  & \quad x \geq 0
  \end{cases}

        $$</span>
        <span>$ p_i(x \in (x_{i-1}; x_i)) = e^{-\frac{x_{i-1}}{\overline{x_в}}} - e^{-\frac{x_{i}}{\overline{x_в}}} $</span>
        <span>Выдвинем гипотезу: $ H_0: X \sim P(\lambda) $</span>
        <span>Выдвинем противоположную гипотезу: $ H_1: X - \mathrm{имеет \, отличное \, от \, показательного \, распределение} $</span>
    </p>

    <table class="w-full mb-4">
        <thead>
        <tr>
            <th class="border px-6 py-4 text-center">$ № $</th>
            <th class="border px-6 py-4 text-center">$ x_{i-1} - x_i $</th>
            <th class="border px-6 py-4 text-center">$ n_i $</th>
            <th class="border px-6 py-4 text-center">$ p_i $</th>
            <th class="border px-6 py-4 text-center">$ n'_i = p_i N $</th>
            <th class="border px-6 py-4 text-center">$ n_i - n'_i $</th>
            <th class="border px-6 py-4 text-center">$ (n_i - n'_i)^2 $</th>
            <th class="border px-6 py-4 text-center">$ \frac{(n_i - n'_i)^2}{n'_i} $</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bigTable['x'] as $interval)
            <tr>
                <td class="border px-6 py-4 text-center">$ {{ $interval['id'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['interval'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['ni'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['pi'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['n`i'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['ni - n`i'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['(ni - n`i)^2'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['(ni - n`i)^2/n`i'] }} $</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td class="border px-6 py-4 text-center">$ {{ $bigTable['x_n'] }} $</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="border px-6 py-4 text-center">$ \chi^2_{набл} = {{ $bigTable['x_chi'] }} $</td>
        </tr>
        </tfoot>
    </table>

    <p class="text-base mb-4 flex flex-col gap-2">
        <span>Число степеней свободы: $ r = k - m - 1 = 10 - 1 - 1 = 8 $</span>
        <span>$ \chi^2_{крит} = 13.362; \; при \, \alpha = 0.100$</span>
        <span>$ \chi^2_{крит} = 15.507; \; при \, \alpha = 0.050$</span>
        <span>$ \chi^2_{крит} = 17.535; \; при \, \alpha = 0.025$</span>
        <span>$ \chi^2_{крит} = 18.168; \; при \, \alpha = 0.020$</span>
        <span>$ \chi^2_{крит} = 20.090; \; при \, \alpha = 0.010$</span>
        <span>$ \chi^2_{крит} = 21.955; \; при \, \alpha = 0.005$</span>
        <span>$ \chi^2_{крит} = 26.124; \; при \, \alpha = 0.001$</span>
    </p>

    <p class="text-base mb-4">
        Вывод: ни при каком уровне значимости $ \alpha $ распределение $ X $ не подчиняется показательному распределению.
        Почему так происходит? Из графика полигона частот мы можем предположить, что наиболее подходящее распределение ― показательное распределение.
        Так как график плавно убывает, что очень напоминает убывающую показательную функцию.
        Но гипотеза $ H_0 $ не подтверждается.
        Из таблицы мы видим, что у нас <strong>очень</strong> тяжёлые концы, которы и составляют большую часть $ \chi^2_{набл} $.
        А интервалы под номерами 6, 7, 8 и 9 практически не накапливают ошибку ― идут почти вровень с показательными распределением.
    </p>

    <h3 class="text-lg mb-4">Обработка одномерной СВ $ Y $.</h3>

    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ Y = \{ y_i \} $</span>
        @php
            $yMin = $usersSortedByY->shift();
            $yMax = $usersSortedByY->pop();
            $n = 1 + 3.22 * (log($totalUsers) / log(10));
//            $resultN = (floor($n) % 2 === 0) ? ceil($n) : floor($n);
//            $resultN = ceil($n);
            $resultN = 11;
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

            <tr>
                <td class=""></td>
                <td class="border px-6 py-4 text-center">$ \sum{n_i} = {{ collect($intervals2)->sum('count') }} $</td>
                <td class="border px-6 py-4 text-center">$ \sum{\omega_i} = {{ collect($intervals2)->sum('frequency') }} $</td>
                <td class=""></td>
            </tr>
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Гистограмма и полигон частот</h3>

    <div class="chart_div_2" style="height: 300px; max-width: 210mm;" data-data="{{ collect($intervals2)->pluck('frequency')->toJson() }}" data-middle="{{ collect($intervals2)->pluck('middle')->toJson() }}" data-labels="[0, 44, 4]"></div>

    <h3 class="text-lg mb-4">Найдём числовые характеристики</h3>
    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ \overline{y}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {y_i \omega_i} = {{ $expectedValue['y']['formula'] }} = {{ $expectedValue['y']['result'] }} $</span>
        <span>$ \overline{D}_в = \displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {y^2_i \omega_i} - (\overline{y}_в)^2 = {{ $expectedValue['y']['formula2'] }} = {{ $expectedValue['y']['result2'] }} $</span>
        <span>$ \sigma_в = \sqrt{\overline{D}_в} = {{ $expectedValue['y']['formula3'] }} = {{ $expectedValue['y']['result3'] }} $</span>
        <span>$ S^2 = \frac{N}{N - 1} \overline{D}_в = {{ $expectedValue['y']['formula4'] }} = {{ $expectedValue['y']['result4'] }} $</span>
        <span>$ S = \sqrt{S^2} = {{ $expectedValue['y']['formula5'] }} = {{ $expectedValue['y']['result5'] }} $</span>
        <span>$ A_S = \frac{\mu^3}{S^3} = \frac{\displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {(y_i - \overline{y_в})^3 \omega_i}}{S^3} = {{ $expectedValue['y']['formula6'] }} = {{ $expectedValue['y']['result6'] }} - \mathrm{коэффициент \, асимметрии} $</span>
        <span>$ E_S = \frac{\mu^4}{S^4} - 3 = \frac{\displaystyle\sum_{i=1}^{ {{ count($intervals2) }} } {(y_i - \overline{y_в})^4 \omega_i}}{S^4} - 3 = {{ $expectedValue['y']['formula7'] }} = {{ $expectedValue['y']['result7'] }} - \mathrm{коэффициент \, эксцесса}$</span>
    </p>

    <h3 class="text-lg mb-4">Найдём эмпирическую функцию распределения и построим ее график.</h3>

    <table class="w-full mb-4">
        <thead>
        <tr>
            <th class="border px-6 py-4 text-center">$ (y_{i - 1}; y_i] $</th>
            <th class="border px-6 py-4 text-center">$ y $</th>
            <th class="border px-6 py-4 text-center">$ F^{\ast}(y) = W(Y < y) $</th>
        </tr>
        </thead>
        <tbody>
        @foreach($empiricalFunctionArrayY as $interval)
            <tr>
                <td class="border px-6 py-4 text-center">$ {{ '(' . $interval['left'] . '; ' . $interval['x'] . ($loop->last ? ')' : ']') }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['x'] }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $interval['y'] }} $</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Кумулята:</h3>

    <div class="chart_div_4" data-data="{{ collect($empiricalFunctionArrayY)->toJson() }}"></div>

    <h2 class="text-xl mb-4">Двумерная выборка:</h2>

{{--    <table class="w-full mb-4">--}}
{{--        <tbody class="text-xs">--}}
{{--        @foreach($double as $values)--}}
{{--            <tr class="first-of-type:font-bold">--}}
{{--                @foreach($values as $value)--}}
{{--                    <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $value === 0 ? '' : $value }}</td>--}}
{{--                @endforeach--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}

    <table class="w-full mb-4">
        <tbody class="text-xs">
        @foreach($doubleXY['y'] as $total_y => $y_values)
            @if ($loop->first)
                <tr class="first-of-type:font-bold">
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ 'Y | X' }}</td>
                    @foreach($doubleXY['x'] as $total_x => $x_values)
                        <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $total_x }}</td>
                    @endforeach
                </tr>
            @endif

            <tr class="first-of-type:font-bold">
                <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $total_y }}</td>
                @foreach($doubleXY['x'] as $total_x => $x_values)
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $doubleXY['values'][$total_x . ' ' . $total_y] }}</td>
                @endforeach
            </tr>

            @if ($loop->last)
                <tr class="first-of-type:font-bold">
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">$ n_x $</td>
                    @foreach($doubleXY['nx'] as $nx)
                        <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $nx }}</td>
                    @endforeach
                </tr>
                <tr class="first-of-type:font-bold">
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">$ y_{x = x_i} $</td>
                    @foreach($doubleXY['yx'] as $yx)
                        <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $yx }}</td>
                    @endforeach
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    <p class="text-base mb-4 flex flex-col gap-2">
        @foreach($doubleXY['$yx'] as $yx)
            <span>$ y_{x = {{ $yx['key'] }} } = {{ $yx['value'] }} = {{ $doubleXY['yx'][$loop->index] }} $</span>
        @endforeach
        <span>$ \overline{XY} = {{ $doubleXY['$XY'] }} = {{ $doubleXY['XY'] }} $</span>
        <span>$ K_{XY} = \overline{XY} - \overline{X} \cdot \overline{Y} = {{ $doubleXY['XY'] }} - {{ $expectedValue['x']['result'] }} \cdot {{ $expectedValue['y']['result'] }} = {{ $doubleXY['KXY'] }} $</span>
        <span>$ r_{xy} = \frac{K_{XY}}{S_x S_y} = {{ '\frac{' . $doubleXY['KXY'] . '}{' . $expectedValue['x']['result5'] . ' \cdot ' . $expectedValue['y']['result5'] . '}' }} = {{ $doubleXY['rxy'] }} $</span>
        <span>$ Y - \overline{Y} = r_{xy} \frac{S_y}{S_x}(X - \overline{X}) $</span>
        <span>$ y - {{ $expectedValue['y']['result'] }} = {{ $doubleXY['rxy'] }} \frac{ {{ $expectedValue['y']['result5'] }} }{ {{ $expectedValue['x']['result5'] }} } (x - {{ $expectedValue['x']['result'] }}) $</span>
        <span>$ y = 0.1971 x  + 8.1991 $</span>
{{--        @php($constanta = round($rxy * ($expectedValue['x']['result5'] / $expectedValue['y']['result5']), 4))--}}
{{--        <span>$ x - {{ $expectedValue['x']['result'] }} = {{ $constanta }} (y - {{ $expectedValue['y']['result'] }}) $</span>--}}
{{--        <span>$ x = {{ $constanta }}y + {{ round($expectedValue['y']['result'] * $constanta, 4) }} + {{ $expectedValue['x']['result'] }} $</span>--}}
{{--        <span>$ x = {{ $constanta }}y + {{ round($expectedValue['y']['result'] * $constanta, 4) + $expectedValue['x']['result'] }} $</span>--}}
    </p>

{{--    <div class="chart_div_5" data-data="{{ json_encode($graphic) }}"></div>--}}
    <div class="chart_div_5" data-data="{{ json_encode($doubleXY['points']) }}"></div>

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
