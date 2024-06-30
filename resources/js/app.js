import './bootstrap';

setTimeout(() => {
    document.querySelectorAll('.alert')
        .forEach(element => element.classList.add('hidden'));
}, 10000);