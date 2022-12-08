// import axios from 'axios';
import { LineChart, Interpolation, BarChart, AutoScaleAxis } from 'chartist';
import 'chartist/dist/index.css';

import.meta.glob([
    '../images/**',
]);
/*new BarChart('.chart_div', {

    labels: ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10'],
    series: [
        [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
    ]
}, {
    high: 10,
    low: -10,
    axisX: {
        labelInterpolationFnc: (value, index) => (index % 2 === 0 ? value : null)
    }
});*/

const chartDiv = document.querySelector('.chart_div');
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
})
// console.log(points2)
// series.push(series[series.length - 1])
// series.unshift(0)
// series.unshift(series[0])
// series.push(0)

const chart = new LineChart(chartDiv, {
    // labels: [-10, 0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110],
    // Naming the series with the series object array notation
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
    // Within the series options you can use the series names
    // to specify configuration that will only be used for the
    // specific series.
    series: {
        'series-1': {
            lineSmooth: Interpolation.step(),
            showArea: true,
        },
        'series-2': {
            lineSmooth: Interpolation.simple(),
            // showArea: true
        },
        // 'series-3': {
        //     showPoint: false
        // }
    }
}, [
    // You can even use responsive configuration overrides to
    // customize your series configuration even further!
    // ['screen and (max-width: 320px)', {
    //     series: {
    //         'series-1': {
    //             lineSmooth: Interpolation.none()
    //         },
            // 'series-2': {
            //     lineSmooth: Interpolation.none(),
            //     showArea: false
            // },
            // 'series-3': {
            //     lineSmooth: Interpolation.none(),
            //     showPoint: true
            // }
        // }
    // }]
]);


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
for (let i = 0, j = 0; i < series2.length; i++, j += 4.4) {
    points4.push({
        x: j,
        y: series2[i]
    })
}
points4.push({
    x: 44,
    y: 0,
})
// console.log(points2)
// series.push(series[series.length - 1])
// series.unshift(0)
// series.unshift(series[0])
// series.push(0)

const chart2 = new LineChart(chartDiv2, {
    // labels: [-10, 0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110],
    // Naming the series with the series object array notation
    series: [{
        name: 'series-1',
        data: points4
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
    // Within the series options you can use the series names
    // to specify configuration that will only be used for the
    // specific series.
    series: {
        'series-1': {
            lineSmooth: Interpolation.step(),
            showArea: true,
        },
        'series-2': {
            lineSmooth: Interpolation.simple(),
            // showArea: true
        },
        // 'series-3': {
        //     showPoint: false
        // }
    }
}, [
    // You can even use responsive configuration overrides to
    // customize your series configuration even further!
    // ['screen and (max-width: 320px)', {
    //     series: {
    //         'series-1': {
    //             lineSmooth: Interpolation.none()
    //         },
            // 'series-2': {
            //     lineSmooth: Interpolation.none(),
            //     showArea: false
            // },
            // 'series-3': {
            //     lineSmooth: Interpolation.none(),
            //     showPoint: true
            // }
        // }
    // }]
]);


// const fileInputs = document.querySelectorAll('input[type=file]');
// const form = document.querySelector('form');
//
// if (fileInputs && form) {
//     fileInputs.forEach((fileInput) => {
//         fileInput.addEventListener('change', (e) => {
//             const formData = new FormData();
//             formData.append(`${e.target.id}`, e.target.files[0]);
//
//             axios.post(form.action, formData)
//                 .then(response => {
//                     console.log(response)
//                 })
//                 .catch(e => {
//                     console.log(e);
//                 });
//         });
//     });
// }
