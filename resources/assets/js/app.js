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
            $('form', this).each(function() {
                this.reset();
            });
            $('[data-empty="modal-close"]', this).empty();
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
                    url: url
                }).then((response) => {
                    $('#feeds').addClass('is-loading');
                    axios.get(route('feedList')).then((response) => {
                        $('#feeds')
                            .removeClass('is-loading')
                            .html(response.data);
                    }).catch((error) => {
                        location.reload();
                    });
                    $modal.modal('hide');
                }).catch((error) => {
                    console.error(error);
                });

                e.preventDefault();
            });

        // Handle post selection
        $('#app').on('click', '[data-toggle="reader"]', function (e) {
            axios.post(route('postUpdate'), {
                id: $(this).attr('data-id'),
                is_read: 1,
            }).catch((error) => {
                console.error(error);
            });
            var $iframe = $('iframe[data-reader]');
            if ($iframe.hasClass('d-none')) {
                $('[data-reader-placeholder]').addClass('d-none');
                $iframe.removeClass('d-none');
            }
        });

        // Handle subscription selection
        // Shows the subscription details and post list
        $('#app').on('click', '[data-toggle="post-list"]', function (e) {
            $('#feeds').children().remove();
            $('<div />').addClass('is-loading').appendTo('#feeds');
            axios.get(route('feedSubscription'), {
                params: {
                    id: $(this).attr('data-id')
                }
            }).then((response) => {
                $('#feeds').html(response.data);
            }).catch((error) => {
                console.error(error);
            });
            e.preventDefault();
        });

        // Handle back button on subscription details
        $('#app').on('click', '[data-toggle="feed-list"]', function (e) {
            $('#feeds').children().remove();
            $('<div />').addClass('is-loading').appendTo('#feeds');
            axios.get(route('feedList')).then((response) => {
                $('#feeds').html(response.data);
            }).catch((error) => {
                console.error(error);
            });
        });
    });
});
