(function ($) {
    "use strict";

    var HT = {
        switchery: function () {
            $(".js-switch").each(function () {
                new Switchery(this, { color: "#1AB394" });
            });
        },
    };

    $(document).ready(function () {
        HT.switchery();
    });
})(jQuery);
