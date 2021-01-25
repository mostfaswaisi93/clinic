// Image Preview
$(".image").change(function() {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});

// Icon Preview
$(".icon").change(function() {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.icon-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
    $('.icon-preview').show();

});