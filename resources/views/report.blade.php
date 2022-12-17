@php
/**
 * @var \App\Models\Report $report
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
            <span>$ \Delta x - \mathrm{размах \, выборки} $</span>
            <span>$ h - \mathrm{величина \, интервала} $</span>
            <span>$ \overline{x}_в, \overline{y}_в - \mathrm{выборочное \, среднее} $</span>
            <span>$ \overline{D}_в - \mathrm{средняя \, выборочная \, дисперсия} $</span>
            <span>$ \sigma_в - \mathrm{выборочное \, среднее \, квадратическое \, отклонение} $</span>
            <span>$ S^2 - \mathrm{несмещённая \, состоятельная \, оценка \, генеральной \, дисперсии} $</span>
            <span>$ S - \mathrm{исправленное \, выборочное \, среднее \, квадратическое \, отклонение} $</span>
            <span>$ A_S - \mathrm{ассиметрия} $</span>
            <span>$ E_S - \mathrm{эксцесс} $</span>
            <span>$ K_{XY} - \mathrm{коэффициент \, ковариации} $</span>
            <span>$ r_{xy} - \mathrm{коэффициент \, корреляции} $</span>
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
            Вариации дискретные, так как имеют изолированные значения: $ X = \{0, 1, 2, \dots, 100\}; \; Y = \{0, 1, 2, \dots, 44\} $.
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
                    @for ($i = 0; $i < ($chunkSize - $report->total % $chunkSize); $i++)
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
                $ N = {{ $report->total }} $
            </td>
        </tr>
        </tfoot>
    </table>

    <h2 class="text-xl mb-6">Первичная обработка результатов эксперимента</h2>

    <h3 class="text-lg mb-4">Обработка одномерной СВ $ X $.</h3>

    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ {{ strtoupper($report->x->type) }} = \{ {{ $report->x->type }}_i \} $</span>
        <span>$ {{ $report->x->type }}_{min} = {{ $report->x->min_value }}; \; m = {{ $report->x->min_values }} $</span>
        <span>$ {{ $report->x->type }}_{max} = {{ $report->x->max_value }};  \; m = {{ $report->x->max_values }} $</span>
        <span>$ \Delta {{ $report->x->type }} = {{ $report->x->type }}_{max} - {{ $report->x->type }}_{min} = {{ $report->x->max_value }} - {{ $report->x->min_value }} = {{ $report->x->sample_size }} $</span>
        <span>Посчитаем число интервалов по формуле Стёрджесса:</span>
        <span>$ n = 1 + 3.22 \lg N = 1 + 3.22 \lg {{ $report->total }} = {{ round(1 + 3.22 * log($report->total, 10), 4) }} \approx {{ $report->x->intervals_number }} $</span>
        <span>$ h = \frac{ \Delta x }{n} = \frac{ {{ $report->x->sample_size }} }{ {{ $report->x->intervals_number }} } = {{ $report->x->interval_value }} $</span>
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
            @foreach($report->x->intervals as $interval)
                <tr>
                    <td class="border px-6 py-4 text-center">$ {{ ($loop->first ? '[' : '(') . $interval->interval[0] . '; ' . $interval->interval[1] . ']' }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->ni }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->wi }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->middle }} $</td>
                </tr>
            @endforeach

            <tr>
                <td class=""></td>
                <td class="border px-6 py-4 text-center">$ \sum{n_i} = {{ $report->x->intervals->sum('ni') }} $</td>
                <td class="border px-6 py-4 text-center">$ \sum{\omega_i} = {{ $report->x->intervals->sum('wi') }} $</td>
                <td class=""></td>
            </tr>
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Гистограмма и полигон частот</h3>

    <div class="chart_div" style="height: 300px; max-width: 210mm;" data-data="{{ $report->x->intervals->pluck('wi')->toJson() }}" data-middle="{{ $report->x->intervals->pluck('middle')->toJson() }}"></div>

    <h3 class="text-lg mb-4">Найдём числовые характеристики</h3>
    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ \overline{ {{ $report->x->type }} }_в = \displaystyle\sum_{i=1}^{ {{ $report->x->intervals_number }} } {x_i \omega_i} = {{ $report->x->fM }} = {{ $report->x->M }} $</span>
        <span>$ \overline{D}_в = \displaystyle\sum_{i=1}^{ {{ $report->x->intervals_number }} } {x^2_i \omega_i} - (\overline{x}_в)^2 = {{ $report->x->fD }} = {{ $report->x->D }} $</span>
        <span>$ \sigma_в = \sqrt{\overline{D}_в} = {{ $report->x->fs }} = {{ $report->x->s }} $</span>
        <span>$ S^2 = \frac{N}{N - 1} \overline{D}_в = {{ $report->x->fS2 }} = {{ $report->x->S2 }} $</span>
        <span>$ S = \sqrt{S^2} = {{ $report->x->fS }} = {{ $report->x->S }} $</span>
        <span>$ A_S = \frac{\mu^3}{S^3} = \frac{\displaystyle\sum_{i=1}^{ {{ $report->x->intervals_number }} } {(x_i - \overline{x_в})^3 \omega_i}}{S^3} = {{ $report->x->fA }} = {{ $report->x->A }} $</span>
        <span>$ E_S = \frac{\mu^4}{S^4} - 3 = \frac{\displaystyle\sum_{i=1}^{ {{ $report->x->intervals_number }} } {(x_i - \overline{x_в})^4 \omega_i}}{S^4} - 3 = {{ $report->x->fE }} = {{ $report->x->E }} $</span>
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
            @foreach($report->x->intervals as $interval)
                @if ($loop->first)
                    <tr>
                        <td class="border px-6 py-4 text-center">$ {{ '(-\infty; ' . $interval->interval[0] . ']' }} $</td>
                        <td class="border px-6 py-4 text-center">$ {{ $interval->interval[0] }} $</td>
                        <td class="border px-6 py-4 text-center">$ 0 $</td>
                    </tr>
                @endif

                <tr>
                    <td class="border px-6 py-4 text-center">$ {{ '(' . $interval->interval[0] . '; ' . $interval->interval[1] . ']' }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->interval[1] }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->accumulative }} $</td>
                </tr>

                @if ($loop->last)
                    <tr>
                        <td class="border px-6 py-4 text-center">$ {{ '(' . $interval->interval[1] . '; +\infty)' }} $</td>
                        <td class="border px-6 py-4 text-center">$ +\infty $</td>
                        <td class="border px-6 py-4 text-center">$ 1 $</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Кумулята:</h3>

    <div class="chart_div_3" data-data="{{ $report->x->intervals->map(fn ($in) => ['x' => $in->interval[1], 'y' => $in->accumulative])->prepend(['x' => 0, 'y' => 0])->push(['x' => $report->x->intervals->last()->interval[1] + $report->x->interval_value, 'y' => 1])->toJson() }}"></div>

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
            <th class="border px-6 py-4 text-center">$ (x_{i-1}; x_i] $</th>
            <th class="border px-6 py-4 text-center">$ n_i $</th>
            <th class="border px-6 py-4 text-center">$ p_i $</th>
            <th class="border px-6 py-4 text-center">$ n'_i = p_i N $</th>
            <th class="border px-6 py-4 text-center">$ n_i - n'_i $</th>
            <th class="border px-6 py-4 text-center">$ (n_i - n'_i)^2 $</th>
            <th class="border px-6 py-4 text-center">$ \frac{(n_i - n'_i)^2}{n'_i} $</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($report->x->intervals as $interval)
                <tr>
                    <td class="border px-6 py-4 text-center">$ {{ $loop->iteration }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ ($loop->first ? '[' : '(') . $interval->interval[0] . '; ' . $interval->interval[1] . ']' }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->ni }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->pi }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->pni }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->dni }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->dni2 }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->pearson }} $</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td class="border px-6 py-4 text-center">$ {{ $report->x->intervals->sum('ni') }} $</td>
                <td class="border px-6 py-4 text-center">$ {{ $report->x->intervals->sum('pi') }} $</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="border px-6 py-4 text-center">$ \chi^2_{набл} = {{ $report->x->intervals->sum('pearson') }} $</td>
            </tr>
        </tbody>
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
        <span>$ {{ strtoupper($report->y->type) }} = \{ {{ $report->y->type }}_i \} $</span>
        <span>$ {{ $report->y->type }}_{min} = {{ $report->y->min_value }}; \; m = {{ $report->y->min_values }} $</span>
        <span>$ {{ $report->y->type }}_{max} = {{ $report->y->max_value }};  \; m = {{ $report->y->max_values }} $</span>
        <span>$ \Delta {{ $report->y->type }} = {{ $report->y->type }}_{max} - {{ $report->y->type }}_{min} = {{ $report->y->max_value }} - {{ $report->y->min_value }} = {{ $report->y->sample_size }} $</span>
        <span>Посчитаем число интервалов по формуле Стёрджесса:</span>
        <span>$ n = 1 + 3.22 \lg N = 1 + 3.22 \lg {{ $report->total }} = {{ round(1 + 3.22 * log($report->total, 10), 4) }} \approx {{ round(1 + 3.22 * log($report->total, 10)) }} $</span>
        <span>Но для удобства счёта возьмём число интервалов $ n = {{ $report->y->intervals_number }} $</span>
        <span>$ h = \frac{ \Delta x }{n} = \frac{ {{ $report->y->sample_size }} }{ {{ $report->y->intervals_number }} } = {{ $report->y->interval_value }} $</span>
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
            @foreach($report->y->intervals as $interval)
                <tr>
                    <td class="border px-6 py-4 text-center">$ {{ ($loop->first ? '[' : '(') . $interval->interval[0] . '; ' . $interval->interval[1] . ']' }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->ni }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->wi }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->middle }} $</td>
                </tr>
            @endforeach

            <tr>
                <td class=""></td>
                <td class="border px-6 py-4 text-center">$ \sum{n_i} = {{ $report->y->intervals->sum('ni') }} $</td>
                <td class="border px-6 py-4 text-center">$ \sum{\omega_i} = {{ $report->y->intervals->sum('wi') }} $</td>
                <td class=""></td>
            </tr>
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Гистограмма и полигон частот</h3>

    <div class="chart_div_2" style="height: 300px; max-width: 210mm;" data-data="{{ $report->y->intervals->pluck('wi')->toJson() }}" data-middle="{{ $report->y->intervals->pluck('middle')->toJson() }}"></div>

    <h3 class="text-lg mb-4">Найдём числовые характеристики</h3>
    <p class="text-base mb-4 flex flex-col gap-2">
        <span>$ \overline{ {{ $report->y->type }} }_в = \displaystyle\sum_{i=1}^{ {{ $report->y->intervals_number }} } {x_i \omega_i} = {{ $report->y->fM }} = {{ $report->y->M }} $</span>
        <span>$ \overline{D}_в = \displaystyle\sum_{i=1}^{ {{ $report->y->intervals_number }} } {x^2_i \omega_i} - (\overline{x}_в)^2 = {{ $report->y->fD }} = {{ $report->y->D }} $</span>
        <span>$ \sigma_в = \sqrt{\overline{D}_в} = {{ $report->y->fs }} = {{ $report->y->s }} $</span>
        <span>$ S^2 = \frac{N}{N - 1} \overline{D}_в = {{ $report->y->fS2 }} = {{ $report->y->S2 }} $</span>
        <span>$ S = \sqrt{S^2} = {{ $report->y->fS }} = {{ $report->y->S }} $</span>
        <span>$ A_S = \frac{\mu^3}{S^3} = \frac{\displaystyle\sum_{i=1}^{ {{ $report->y->intervals_number }} } {(x_i - \overline{x_в})^3 \omega_i}}{S^3} = {{ $report->y->fA }} = {{ $report->y->A }} $</span>
        <span>$ E_S = \frac{\mu^4}{S^4} - 3 = \frac{\displaystyle\sum_{i=1}^{ {{ $report->y->intervals_number }} } {(x_i - \overline{x_в})^4 \omega_i}}{S^4} - 3 = {{ $report->y->fE }} = {{ $report->y->E }} $</span>
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
            @foreach($report->y->intervals as $interval)
                @if ($loop->first)
                    <tr>
                        <td class="border px-6 py-4 text-center">$ {{ '(-\infty; ' . $interval->interval[0] . ']' }} $</td>
                        <td class="border px-6 py-4 text-center">$ {{ $interval->interval[0] }} $</td>
                        <td class="border px-6 py-4 text-center">$ 0 $</td>
                    </tr>
                @endif

                <tr>
                    <td class="border px-6 py-4 text-center">$ {{ '(' . $interval->interval[0] . '; ' . $interval->interval[1] . ']' }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->interval[1] }} $</td>
                    <td class="border px-6 py-4 text-center">$ {{ $interval->accumulative }} $</td>
                </tr>

                @if ($loop->last)
                    <tr>
                        <td class="border px-6 py-4 text-center">$ {{ '(' . $interval->interval[1] . '; +\infty)' }} $</td>
                        <td class="border px-6 py-4 text-center">$ +\infty $</td>
                        <td class="border px-6 py-4 text-center">$ 1 $</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <h3 class="text-lg mb-4">Кумулята:</h3>

    <div class="chart_div_4" data-data="{{ $report->y->intervals->map(fn ($in) => ['x' => $in->interval[1], 'y' => $in->accumulative])->prepend(['x' => 0, 'y' => 0])->push(['x' => $report->y->intervals->last()->interval[1] + $report->y->interval_value, 'y' => 1])->toJson() }}"></div>

    <h2 class="text-xl mb-4">Двумерная выборка:</h2>

    <table class="w-full mb-4">
        <tbody class="text-xs">
            <tr class="first-of-type:font-bold">
                <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ 'Y | X' }}</td>
                @foreach($report->x->intervals as $int_x)
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $int_x->middle }}</td>
                @endforeach
            </tr>

            @foreach($report->y->intervals as $int_y)
                <tr class="first-of-type:font-bold">
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $int_y->middle }}</td>
                    @foreach($report->x->intervals as $int_x)
                        <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $report->doubleXY['values'][$int_x->middle . ' ' . $int_y->middle] }}</td>
                    @endforeach
                </tr>
            @endforeach

            <tr class="first-of-type:font-bold">
                <td class="first-of-type:font-bold border px-1 py-1 text-center">$ n_x $</td>
                @foreach($report->doubleXY['nx'] as $nx)
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $nx }}</td>
                @endforeach
            </tr>
            <tr class="first-of-type:font-bold">
                <td class="first-of-type:font-bold border px-1 py-1 text-center">$ y_{x = x_i} $</td>
                @foreach($report->doubleXY['yx'] as $yx)
                    <td class="first-of-type:font-bold border px-1 py-1 text-center">{{ $yx }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <p class="text-base mb-4 flex flex-col gap-2">
        @foreach($report->doubleXY['$yx'] as $yx)
            <span>$ y_{x = {{ $yx['key'] }} } = {{ $yx['value'] }} = {{ $report->doubleXY['yx'][$loop->index] }} $</span>
        @endforeach
        <span>$ \overline{XY} = {{ $report->doubleXY['$XY'] }} = {{ $report->doubleXY['XY'] }} $</span>
        <span>$ K_{XY} = \overline{XY} - \overline{X} \cdot \overline{Y} = {{ $report->doubleXY['XY'] }} - {{ $report->x->M }} \cdot {{ $report->y->M }} = {{ $report->doubleXY['KXY'] }} $</span>
        <span>$ r_{xy} = \frac{K_{XY}}{S_x S_y} = {{ '\frac{' . $report->doubleXY['KXY'] . '}{' . $report->x->S . ' \cdot ' . $report->y->S . '}' }} = {{ $report->doubleXY['rxy'] }} $</span>
        <span>$ Y - \overline{Y} = r_{xy} \frac{S_y}{S_x}(X - \overline{X}) $</span>
        <span>$ y - {{ $report->y->M }} = {{ $report->doubleXY['rxy'] }} \frac{ {{ $report->y->S }} }{ {{ $report->x->S }} } (x - {{ $report->x->M }}) $</span>
        <span>$ y = 0.1971 x  + 8.1991 $</span>
    </p>

    <div class="chart_div_5" data-data="{{ json_encode($report->doubleXY['points']) }}"></div>
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
