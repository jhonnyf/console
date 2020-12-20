axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const openUpload = function () {

    let src = $(this).data('url');

    axios.get(src)
        .then(function (response) {
            response = response.data;
             
            $.fancybox.open({
                src: response.result,
                type: 'inline',
                opts: {
                    'modal': true
                }
            });

            let url = $('#dropzone-form').attr('action');
            $('#dropzone-form').dropzone({ url: url });
        });
}

const editForm = function () {

    let src = $(this).data('url');

    axios.get(src)
        .then(function (response) {
            response = response.data;
             
            $.fancybox.open({
                src: response.result,
                type: 'inline',
                opts: {
                    'modal': true
                }
            });
        });
}

$(".open-upload").click(openUpload);
$(".edit-form").click(editForm);