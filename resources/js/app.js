import { LineChart, Interpolation, AutoScaleAxis } from 'chartist';
import 'chartist/dist/index.css';
import Alpine from 'alpinejs';

const chartDiv = document.querySelector('.chart_div');
if (chartDiv) {
    const series = JSON.parse(chartDiv.dataset.data);
    const middles = JSON.parse(chartDiv.dataset.middle);

    const points = [];
    for (let i = 0; i < middles.length; i++) {
        points.push({
            x: middles[i],
            y: series[i],
        })
    }

    const points2 = [];
    for (let i = 0, j = 0; i < series.length; i++, j += 10) {
        points2.push({
            x: j,
            y: series[i]
        })
    }
    points2.push({
        x: 100,
        y: 0,
    });

    new LineChart(chartDiv, {
        series: [{
            name: 'series-1',
            data: points2
        }, {
            name: 'series-2',
            data: points
        }]
    }, {
        axisX: {
            type: AutoScaleAxis,
            onlyInteger: true
        },
        fullWidth: true,
        series: {
            'series-1': {
                lineSmooth: Interpolation.step(),
                showPoint: false,
                showArea: true,
            },
            'series-2': {
                lineSmooth: Interpolation.simple(),
            }
        }
    });


    const chartDiv2 = document.querySelector('.chart_div_2');
    const series2 = JSON.parse(chartDiv2.dataset.data);
    const middles2 = JSON.parse(chartDiv2.dataset.middle);

    const points3 = [];
    for (let i = 0; i < middles2.length; i++) {
        points3.push({
            x: middles2[i],
            y: series2[i],
        })
    }

    const points4 = [];
    for (let i = 0, j = 0; i < series2.length; i++, j += 4) {
        points4.push({
            x: j,
            y: series2[i]
        })
    }
    points4.push({
        x: 44,
        y: 0,
    });

    new LineChart(chartDiv2, {
        series: [{
            name: 'series-1',
            data: points4,
        }, {
            name: 'series-2',
            data: points3
        }]
    }, {
        axisX: {
            type: AutoScaleAxis,
            onlyInteger: true
        },
        fullWidth: true,
        series: {
            'series-1': {
                lineSmooth: Interpolation.step(),
                showPoint: false,
                showArea: true,
            },
            'series-2': {
                lineSmooth: Interpolation.simple(),
            }
        }
    });


    const chartDiv3 = document.querySelector('.chart_div_3');
    let series3 = JSON.parse(chartDiv3.dataset.data);
    series3 = [{
        x: 0, y: 0
    }, ...series3.slice(1, series3.length - 1), {
        x: series3.slice(1, series3.length - 1).pop().x + 10, y: 1
    }];

    new LineChart(chartDiv3, {
        series: [{
            name: 'series-1',
            data: series3
        }]
    }, {
        axisX: {
            type: AutoScaleAxis,
            onlyInteger: true
        },
        fullWidth: true,
        showPoint: false,

        series: {
            'series-1': {
                // lineSmooth: Interpolation.cardinal(),
                lineSmooth: Interpolation.step({
                    postpone: false
                }),
            }
        }
    });

    const chartDiv4 = document.querySelector('.chart_div_4');
    let series4 = JSON.parse(chartDiv4.dataset.data);

    new LineChart(chartDiv4, {
        series: [{
            name: 'series-1',
            data: series4
        }]
    }, {
        axisX: {
            type: AutoScaleAxis,
            onlyInteger: true
        },
        fullWidth: true,
        showPoint: false,
        series: {
            'series-1': {
                lineSmooth: Interpolation.step({
                    postpone: false
                }),
            }
        }
    });

    const chartDiv5 = document.querySelector('.chart_div_5');
    let series5 = JSON.parse(chartDiv5.dataset.data);
    const line = (x) => 0.1971 * x + 8.1991;

    new LineChart(chartDiv5, {
        series: [{
            name: 'series-1',
            data: series5
        }, {
            name: 'series-2',
            data: [{x: 0, y: line(0)}, {x: 100, y: line(100)}]
        }]
    }, {
        axisX: {
            type: AutoScaleAxis,
            onlyInteger: true
        },
        fullWidth: true,
        series: {
            'series-1': {
                lineSmooth: Interpolation.none(),
            },
            'series-2': {
                lineSmooth: Interpolation.none(),
            }
        }
    });
}

window.Alpine = Alpine;

Alpine.start();
