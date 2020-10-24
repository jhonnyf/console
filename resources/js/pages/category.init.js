window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$('a[data-ajax]').click(function () {
    var id = $(this).data('id');
    var url = $(this).data('ajax');

    window.axios.post(url, {
        'id': id
    })
        .then(function (response) {
            var response = response.data;
            if (response.error === false) {
                $('.structure-category').append(response.result.html);
                feather.replace();
            }
        });
});