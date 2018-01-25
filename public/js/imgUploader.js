$(document).ready(function () {
    $(document).on('change', '#logo', function (event) {
        var $elem = $(event.currentTarget);
        if (event.currentTarget.files && event.currentTarget.files[0]) {
            iconReader(event.currentTarget.files[0]);
        }
    });

    function iconReader(file) {
        var that = this;
        var reader = new FileReader();
        reader.onload = function (event) {
            $('.imageContainer').html('<img src="' + event.target.result + '"/>')
        };
        reader.readAsDataURL(file);
    }
});
