import './bootstrap';

// Accordion component

window.toggleMenu = function(event) {
    var button = event.currentTarget;
    var menu = button.nextElementSibling;
    var parent = button.parentElement;

    menu.classList.toggle('hidden');
    parent.classList.toggle('border-b');
}

window.onload = function() {
    var menus = document.querySelectorAll('.accordion-menu');
    menus.forEach(function(menu) {
        menu.classList.add('hidden');
        menu.style.transition = 'all 0.3s ease-in-out';
    });

    var parents = document.querySelectorAll('.accordion-parent');
    parents.forEach(function(parent) {
        parent.classList.add('border-b');
    });
}


// Choose multiple options
$(document).ready(function() {
    $('#tags').select2();
});
