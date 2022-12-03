import axios from 'axios';

import.meta.glob([
    '../images/**',
]);

const fileInputs = document.querySelectorAll('input[type=file]');
const form = document.querySelector('form');

if (fileInputs && form) {
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener('change', (e) => {
            const formData = new FormData();
            formData.append(`${e.target.id}`, e.target.files[0]);

            axios.post(form.action, formData)
                .then(response => {
                    console.log(response)
                })
                .catch(e => {
                    console.log(e);
                });
        });
    });
}
