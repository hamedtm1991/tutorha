import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import Popper from 'popper.js';
window.Popper = Popper;

import slick from 'slick-carousel';
window.slick = slick;

import select2 from 'select2';
select2();

import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

document.addEventListener('livewire:initialized', () => {
    Livewire.on('toast', (data) => {
        Toast.fire({
            icon: data.type,
            title: data.message
        })
    })
});

window.getConfirm = function (action, event, id, title, text, optionalParameter) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#02b97c',
        cancelButtonColor: '#e42d29',
        confirmButtonText: 'بله',
        cancelButtonText: 'خیر'
    }).then((result) => {
        if (result.isConfirmed) {
            if (action) {
                Livewire.dispatchTo('', action, event, [id], optionalParameter)
            }
        }
    });
};
