!function ($) {
    "use strict";

    var Components = function () { };

    Components.prototype.initCustomSelect = function () {
        $('[data-plugin="customselect"]').select2();
    },

        Components.prototype.init = function () {
            var $this = this;
            this.initCustomSelect()
        },

        $.Components = new Components, $.Components.Constructor = Components

}(window.jQuery),
    //initializing main application module
    function ($) {
        "use strict";
        $.Components.init();
    }(window.jQuery);