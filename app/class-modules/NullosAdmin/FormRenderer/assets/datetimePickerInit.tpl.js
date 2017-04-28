function init_daterangepicker() {

    if (typeof ($.fn.daterangepicker) === 'undefined') {
        return;
    }
    console.log('init_daterangepicker');

    var conf = jsConfig;
    $('#{elementId}').daterangepicker(conf);
}

init_daterangepicker();



