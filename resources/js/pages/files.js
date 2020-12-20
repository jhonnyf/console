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
                    'modal': true,
                    afterLoad: function () {
                        $('.form-ajax').submit(saveForm);
                    }
                }
            });
        });
}

const saveForm = function () {
    let element = $(this);

    let src = element.attr('action');
    let data = element.serialize();

    axios.put(src, data)
        .then(function (response) {
            response = response.data;            

            element.prepend(response.message);
            setTimeout(() => {
                element.find('.alert').fadeOut(function(){
                    $(this).remove();
                });
            }, 2000);
        });

    return false;
}

$(".open-upload").click(openUpload);
$(".edit-form").click(editForm);