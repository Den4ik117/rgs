@php
/**
 * @var \Illuminate\Support\Collection $usersSortedByX
 */
@endphp
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
<body class="antialiased bg-white p-4">
<article>
    <h1 class="text-2xl mb-8">Расчётно-графическая работа по математической статистике</h1>

    <table class="w-full mb-8">
        <thead>
        <tr>
            @for($i = 0; $i < $chunkSize; $i++)
                <th class="border px-6 py-4 text-center border-l-2 border-t-2 border-b-2 border-gray-300">$X$</th>
                <th class="border px-6 py-4 text-center border-r-2 border-t-2 border-b-2 border-gray-300">$Y$</th>
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
        @endphp
        <span>$ x_{min} = {{ $xMin->first()->total_x }} \, ({{ $usersSortedByX->shift()->first()->total_x }}); \; m = {{ $xMin->count() }} $</span>
        <span>$ x_{max} = {{ $xMax->first()->total_x }} \, ({{ $usersSortedByX->pop()->first()->total_x }}); \; m = {{ $xMax->count() }} $</span>
        <span>$ x_{max} - x_{min} = {{ $xMax->first()->total_x }} - {{ $xMin->first()->total_x }} = {{ $xMax->first()->total_x - $xMin->first()->total_x }} - \mathrm{размах \, выборки} $</span>
        <span>$ n = 1 + 3.22 \lg N = 1 + 3.22 \frac{\ln N}{\ln 10} = 1 + 3.22 \frac{\ln {{ $totalUsers }}}{\ln 10} = {{ $n }} \approx {{ (floor($n) % 2 === 0) ? ceil($n) : floor($n) }} - \mathrm{число \, интервалов} $</span>
        <span></span>
    </p>


{{--        $$ x^2 = 2y + 2 $$--}}

</article>

<script>
    MathJax = {
        tex: {
            inlineMath: [['$', '$'], ['\\(', '\\)']]
        }
    };
</script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>
</html>
