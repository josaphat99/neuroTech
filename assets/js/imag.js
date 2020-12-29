$(function() {
    //les images
    console.log('imag');
    $('.image').hide();

    $('.add-image').click(function(e) {
        e.preventDefault();

        var id = e.target.getAttribute('id').split('-')[1];

        $('#img-div' + id).removeAttr('hidden');

        $('#image' + id).click();

        $('#image' + id).change(function(e) {
            if ($('#image' + id).val() != '') {
                $('#image-name' + id).html($('#image' + id).val());
            }
        })

    })

    $('.nbimg').click(function(e) {
        e.preventDefault();

        var id = e.target.getAttribute('id').split('-')[1];

        $('#plus-image-' + id).removeAttr('hidden');
        $('#error_image' + id).attr('hidden', true);
        $('#error_nb_image' + id).attr('hidden', true);
    })
})