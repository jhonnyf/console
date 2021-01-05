axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const searchProduct = function () {
    let url = $(this).data('url');

    axios.get(url)
        .then(function (response) {
            response = response.data;

            $.fancybox.open({
                src: response.result,
                type: 'html',
                opts: {
                    modal: true,
                    closeExisting: true,
                    afterLoad: function () {
                        $(document).on('submit', '.form-ajax', search);
                    }
                }
            });
        });
}

const search = () => {
    let element = $('.form-ajax');
    let data = element.serialize();
    let url = element.attr('action');

    axios.post(url, data).then(function (response) {
        response = response.data;
        
        console.log(response);
    });

    return false;
}


$(document).on('click', '.btn-search-product', searchProduct);
