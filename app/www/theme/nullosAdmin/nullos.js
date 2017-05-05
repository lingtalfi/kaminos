/**
 * This file is owned by the nullosAdmin theme, which was made for the NullosAdmin module.
 */
(function ($) {


    var options;


    //----------------------------------------
    // SOME PRIVATE FUNCTIONS
    //----------------------------------------
    function getActionLinkDataAttributes(jEl) {
        return $.extend({
            id: 0,
            confirm: "", // false=>empty, true=>1
            confirmtext: "Are you sure you want to execute this action?", // note, jquery lower cases the attributes names
            label: "",
            uri: "/actionlink-handler",
            type: "modal"
        }, jEl.data());
    }


    function error(msg) {
        console.log("dataTable error: " + msg);
    }


    //----------------------------------------
    // CREATING THE NULLOS NAMESPACE
    //----------------------------------------
    $.fn.nullos = function (_options) {
        options = $.extend({}, $.fn.nullos.defaults, _options);
    };


    //----------------------------------------
    // HANDLE RESPONSE (GSCP)
    //----------------------------------------
    $.fn.nullos.handleResponse = function (response, success) {
        if ('type' in response) {
            if ('data' in response) {
                if ('success' === response.type) {
                    success(response.data);
                }
                else if ('error' === response.type) {
                    options.modalResponse('error', response.data);
                }
                else {
                    error("Unknown response type: " + response.type);
                }
            }
            else {
                error("key 'data' not found in response");
            }
        }
        else {
            error("key 'type' not found in response");
        }
    };

    //----------------------------------------
    // HANDLE ACTION LINK
    //----------------------------------------
    $.fn.nullos.handleActionLink = function (jEl) {

        var value = jEl.val();
        if ('0' === value) {
            return;
        }

        /**
         * Note: data-* attributes case seemed
         * to be strlowered
         */
        var data = getActionLinkDataAttributes(jEl, type);

        var fn = function () {


            if (
                'modal' === data.type ||
                'post' === data.type ||
                'refreshOnSuccess' === data.type ||
                'quietOnSuccess' === data.type
            ) {

                var postData = {
                    id: data.id
                };

                $.post(data.uri, postData, function (response) {
                    if ('post' === data.type) {
                        window.location.reload();
                        return;
                    }

                    handleResponse(response, function (d) {
                        if ('refreshOnSuccess' === data.type) {
                            window.location.reload();
                            return;
                        }
                        if ('modal' === data.type) {
                            options.modalResponse('success', d);
                        }
                        if ('quietOnSuccess' === data.type) {
                            // does nothing
                        }
                    });
                }, 'json');
            }
            else if ('flat' === data.type) {
                location.href = data.uri;
            }
        };
        if (1 === data.confirm) {
            if (true === window.confirm(data.confirmtext)) {
                fn();
            }
        }
        else {
            fn();
        }
    };

    //----------------------------------------
    // DEFAULT OPTIONS
    //----------------------------------------
    $.fn.nullos.defaults = {
        modalResponse: function (type, msg) {
            alert("NullosModal of type " + type + ": " + msg);
        }
    };

    //----------------------------------------
    // INIT FUNCTIONS
    //----------------------------------------
    function initActionLinks() {
        $('body').on('click', function (e) {
            var jTarget = $(e.target);
            if (jTarget.hasClass('special-link')) {
                $.fn.nullos.handleActionLink(jTarget);
            }
        });
    }

    $(document).ready(function () {
        initActionLinks();
    });

})(jQuery);
