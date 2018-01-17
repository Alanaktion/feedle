require('./bootstrap');

require(['jquery', 'bootstrap', 'axios'], function ($, Bootstrap, axios) {
    $(document).ready(function() {
        // Show tooltips on hover
        $('button,a').filter('[data-hover="tooltip"]').tooltip();

        // Autofocus inputs in modals
        $('.modal').on('shown.bs.modal', function (e) {
            $(this).find('[data-autofocus]').focus();
        });

        // Clear forms when modals are closed
        $('.modal').on('hidden.bs.modal', function (e) {
            $(this).find('form').each(function() {
                this.reset();
            });
        });

        // Handle Add Feed form submit
        $('[data-submit="find-feed"]').on('submit', function(e) {
            var $form = $(this);
            var $input = $form.find('input[name="url"]');
            $input.prop('disabled', true).blur();
            var $result = $form.siblings('[data-content="result"]');
            $result.empty().addClass('is-loading');

            var action = $form.attr('action');
            var url = $input.val();
            axios.get(action, {
                params: {
                    url: url
                }
            }).then((response) => {
                $input.prop('disabled', false).focus();
                $result.html(response.data).removeClass('is-loading');
            }).catch((error) => {
                console.error(error);
            });

            e.preventDefault();
        });

        // Handle result Add Feed button
        $('[data-content="result"]')
            .on('submit', '[data-submit="add-feed"]', function (e) {
                var $form = $(this);
                var $input = $(this).find('input[name="url"]');
                var $button = $form.find('button');
                var $modal = $button.closest('.modal');
                $button.addClass('is-loading');

                var action = $form.attr('action');
                var url = $input.val();
                axios.post(action, {
                    params: {
                        url: url
                    }
                }).then((response) => {
                    $modal.modal('hide');
                }).catch((error) => {
                    console.error(error);
                });

                e.preventDefault();
            });
    });
})
