<template>
    <div class="flex flex-col gap-2 border border-2 border-indigo-400 rounded p-4">
        <input type="hidden" name="samples" :value="JSON.stringify(samples)">
        <div class="grid grid-cols-2 gap-2">
            <div class="text-center">X</div>
            <div class="text-center">Y</div>

            <template v-for="(sample, index) in samples" :key="sample.id">
                <div class="col-span-2 flex gap-4 items-center">
                    <input type="checkbox" name="select" class="flex-none w-6 h-6 cursor-pointer" :value="sample.id" v-model="checkedRows" tabindex="-1">
                    <input type="number" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" v-model="samples[index].x" required>
                    <input type="number" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" v-model="samples[index].y" required>
                </div>
            </template>

            <div v-if="checkedRows.length" class="col-span-2 flex gap-4 items-center mt-2">
                <p>С выделенными:</p>
                <DangerButton type="button" @click="deleteRows">Удалить</DangerButton>
            </div>

            <input type="number" min="1" max="100" step="1" class="mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" v-model="count">
            <button type="button" @click="add" class="mt-4 inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Добавить ряды
            </button>
        </div>
    </div>
</template>

<script>
import {ref, onMounted} from "vue";
import {idGenerator} from "../../utils.js";
import DangerButton from "../DangerButton.vue";

export default {
    components: {DangerButton},
    setup() {
        const generator = idGenerator();
        const samples = ref([]);
        const count = ref(1);
        const checkedRows = ref([]);

        const constructor = ({x = null, y = null}) => ({
            id: generator(),
            x,
            y,
        });

        const pushMany = (elementsNumber) => {
            for (let i = 0; i < elementsNumber; i++) {
                samples.value.push(constructor({}));
            }
        };

        const add = () => {
            pushMany(count.value);
            count.value = 1;
        };

        const deleteRows = () => {
            samples.value = samples.value.filter((sample) => {
                return !checkedRows.value.includes(sample.id);
            });
            checkedRows.value = [];
        };

        onMounted(() => {
            const sample = document.querySelector('.sample');

            if (sample) {
                const propSamples = JSON.parse(sample.dataset.data);

                if (Array.isArray(propSamples) && propSamples.length) {
                    for (const {x = null, y = null} of propSamples) {
                        samples.value.push(constructor({x, y}));
                    }
                } else if (localStorage.hasOwnProperty('samples')) {
                    const str = localStorage.getItem('samples');
                    if (str) {
                        const localSamples = JSON.parse(str);

                        for (const {x = null, y = null} of localSamples) {
                            samples.value.push(constructor({x, y}));
                        }
                    }
                } else {
                    samples.value.push(constructor({}));
                }
            }

            setInterval(() => {
                localStorage.setItem('samples', JSON.stringify(samples.value));
                // console.log(localStorage.getItem('samples'));
            }, 5000);

            const form = document.querySelector('#sampleForm');

            if (form) {
                form.addEventListener('submit', () => {
                    localStorage.removeItem('samples');
                });
            }
        });

        return {
            samples,
            add,
            count,
            checkedRows,
            deleteRows,
        };
    }
}
</script>
