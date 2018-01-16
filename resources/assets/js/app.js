require('./bootstrap');

console.log(window.jQuery);

require(['jquery', 'bootstrap'], function ($) {
    $(document).ready(function() {
        $('button,a').filter('[data-toggle="tooltip"]').tooltip();
    });
})
