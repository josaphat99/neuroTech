$(function() {
    $('.image').hide();

    $('.add-image').click(function(e) {
        e.preventDefault();

        var id = e.target.getAttribute('id');

        $('#image' + id).click();

        $('#image' + id).change(function(e) {
            if ($('#image' + id).val() != '') {
                $('#image-name' + id).html($('#image' + id).val());
            }
        })

    })
})