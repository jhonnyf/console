"use strict";

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

var Files = function () {

    var openUpload = function () {

        var element = $(this);
        var src = element.data('url');

        $.ajax({
            url: src,
            dataType: 'json'
        }).done(function (response) {

            $.fancybox.open({
                src: response.result,
                type: 'inline',
                opts: {
                    'modal': true
                }
            });

            var url = $('#dropzone-form').attr('action');
            $('#dropzone-form').dropzone({ url: url });

        });

    }

    return {
        init: function () {

            $(document).on('click', '.open-upload', openUpload);
        }
    }
}();

if (typeof module !== 'undefined') {
    module.exports = Files;
}

jQuery(document).ready(function () {
    Files.init();
});