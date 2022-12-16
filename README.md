## Расчётно-графическая работа по математической статистике

Задача: выбрать 2 случайные величины Х и У с количественным признаком (придумать  самостоятельно).
СВ должны быть заведомо зависимые.
После этого выполняем их исследование по мере прохождения материала на лекциях и практиках по математической статистике.

[Сайт с расчётно-графической работой](https://rgs.deniszagvozdin.ru/)

### Как пользоваться

1. Зайти на страницу с полным отчётом
2. Нажать сочетание клавиш `Ctrl + P`
3. В открывшемся окне в опциях принтера выбрать `Сохранить как PDF`
4. В дополнительных настройках отключить верхние и нижние колонтитулы
5. Все остальные настройки оставить по умолчанию
6. Нажать кнопку `Сохранить`

Данная инструкция актуальна для Desktop-версии Google Chrome.

### Код

Кому интересно, как это работает «под капотом», то вот 2 файла, в которых находится бизнес-логика, отвечающая за вывод информации:

1. `/app/Http/Controllers/ReportController.php`
2. `/resources/views/report.blade.php`

### Прогресс

<table>
    <thead>
        <tr>
            <th>Требование</th>
            <th>X</th>
            <th>Y</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>составить вариационный ряд</td>
            <td>+</td>
            <td>+</td>
        </tr>
        <tr>
            <td>построить полигон и гистограмму частот</td>
            <td>+</td>
            <td>+</td>
        </tr>
        <tr>
            <td>найти эмпирическую функцию распределения и построить ее график</td>
            <td>+</td>
            <td>+</td>
        </tr>
        <tr>
            <td>рассчитать выборочную среднюю и выборочную дисперсию, среднее квадратичное отклонение, асимметрию, эксцесс</td>
            <td>+</td>
            <td>+</td>
        </tr>
        <tr>
            <td>определить доверительный интервал для оценки математического ожидания при надежности 0,95</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td>установить уровень значимости, при котором распределение для выборки согласуется с нормальным законом (или более подходящим, судя по полигону частот, распределением) по критерию Пирсона</td>
            <td>+</td>
            <td>-</td>
        </tr>
        <tr>
            <td>проверить по критерию Пирсона, согласуется ли распределение с распределением Коши</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td>определить первые начальные и вторые центральные моменты</td>
            <td>+</td>
            <td>+</td>
        </tr>
        <tr>
            <td>построить эмпирическую линию регрессии</td>
            <td colspan="2">+</td>
        </tr>
        <tr>
            <td>найти уравнение теоретической линии регрессии Y по X или X по Y, обе линии построить в одной системе координат</td>
            <td colspan="2">+</td>
        </tr>
    </tbody>
</table>
