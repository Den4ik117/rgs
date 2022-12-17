import { createApp } from "vue";
import SamplesForm from "./components/samples/SamplesForm.vue";

import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();

const admin = document.querySelector('.sample');

if (admin) {
    createApp(SamplesForm).mount(admin);
}
