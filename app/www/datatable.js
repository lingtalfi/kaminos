(function ($) {

    $.fn.dataTable = function (options) {


        options = $.extend({}, $.fn.dataTable.defaults, options);
        console.log(options);


        function error(msg) {
            console.log("dataTable error: " + msg);
        }

        function refresh(jElem, initialSend) {
            var profileId = jElem.attr('data-id');


            var data = {
                id: profileId
            };

            if (true !== initialSend) {
                data.searchValues = [];
                data.sortValues = [];
                data.page = 1;
                data.nipp = 20;
            }

            $.post(options.uri, data, function (zedata) {
                handleResponse(zedata, function (html) {
                    jElem.empty();
                    jElem.append(html)
                });
            }, 'json');
        }


        function handleResponse(response, success) {
            if ('type' in response) {
                if ('data' in response) {
                    if ('success' === response.type) {
                        success(response.data);
                    }
                    else if ('error' === response.type) {
                        options.modalError(response.data);
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
        }


        return this.each(function () {
            var jElem = $(this);

            jElem.on('click', function (e) {
                var jTarget = $(e.target);
            });
            refresh(jElem, true);
        });
    };


    $.fn.dataTable.defaults = {
        uri: "/datatable-handler",
        modalError: function (msg) {
            alert(msg);
        }
    };
})(jQuery);