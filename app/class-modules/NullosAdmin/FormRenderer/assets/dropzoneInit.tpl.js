function init_daterangepicker() {

    if (typeof ($.fn.daterangepicker) === 'undefined') {
        return;
    }
    console.log('init_daterangepicker');

    var conf = jsConfig;
    $('#{elementId}').daterangepicker(conf);
}

init_daterangepicker();


var myDropzone = new Dropzone("div#elementId", {
    url: "/uploads",
    paramName: "nameOfFile", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    accept: function (file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don\'t.");
        }
        else {
            done();
        }
    }
});
