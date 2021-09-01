$(document).ready(function() {

    $(".countriesList").select2({
        width: '100%',
        templateResult: function formatState(state) {
            return $('<span>' + state.text + '</span>');
        }
    });

    $('[data-toggle="tooltip"]').tooltip(),

        Ladda.bind('button[type=submit]');

    $('.image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom',
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300
        }
    });

    $('.image-popup-gallery').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom',
        gallery: {
            enabled: true
        },
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300
        }
    });

    $(document).on("click", '.active-modal', function(e){

        e.preventDefault();

        let $availableSizes = ['small', 'large'];

        let $size = $(this).attr('data-size');

        if(!$availableSizes.includes($size)){

            $size = 'large';
        }

        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function ($data) {
                bootbox.dialog({
                    size: $size,
                    title: " ",
                    message: $data,
                });
            }
        });
    });

    $(document).on("click", '.submit-modal', function(){

        let $action = $(this).attr('data-action');

        let $form = $('form[data-async]');

        let $data = $form.serializeArray();

        $data.push({name: 'action', value: $action});

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                $('.modal-content').html(data);
            }
        });

        return false;
    });

    $('.upload-image').on('change', function () {

        let element = $(this);

        let input = document.getElementById(element.attr('id'));

        let preview = element.closest('.img-container').find('.img-preview');

        preview.find('div:first-child').append('<div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #5a6268; opacity: 0.3; z-index: 1;"></div>').append('<i class="fas fa-sync fa-spin text-white fa-3x" style="position: absolute; top: 50%; left:50%;     margin-left: -25px; margin-top: -25px; z-index: 9;"></i>');

        if (!(input.files && input.files[0])) {
            return;
        }

        let reader = new FileReader();

        reader.onload = function (e) {

            let result = e.target.result;

            setTimeout(function () {

                if ($('.img-preview').length) {

                    preview.find('div:first-child').html('<img src="' + result + '" class="img-thumbnail ' + element.attr('data-class') + '" style="' + element.attr('data-style') + '">')

                } else {

                    preview.find('div:first-child').find('img').attr('src', result);
                }

            }, 1000)
        };
        reader.readAsDataURL(input.files[0]);
    });

    $(document).on("click", ".btn-alert", function(e){

        e.preventDefault();

        let $url = $(this).attr('href');

        let $method = $(this).attr('data-method') ? $(this).attr('data-method') : 'POST';

        let $data = [];

        let $action;

        let $redirect = $(this).attr('data-redirect') ? $(this).attr('data-redirect') : null;

        $action = $(this).attr('data-action');

        if($action === 'delete'){

            $method = 'DELETE';

            $data.push({name: '_method', value: 'delete'});
        }

        swal.fire({
            title: $(this).attr('data-title') ? $(this).attr('data-title') : 'Are you sure?',
            text: $(this).attr('data-text') ? $(this).attr('data-text') : 'You will not be able to recover this!',
            type: $(this).attr('data-icon') ? $(this).attr('data-icon') : 'error',
            //buttons: true,
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonColor: $action === 'delete' ? '#d33' : '#3085d6',
        }).then(d => {

            data = d;

            return data;

        }).then(result => {

            if (result.value) {

                $.ajax({
                    url: $url,
                    type: $method,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    dataType: "json",
                    success: function(result) {

                        if(result.success){

                            let $message = 'Record has been';

                            if($action === 'add'){

                                $message = $message + ' added!';

                            } else if($action === 'update'){

                                $message = $message + ' updated!';

                            } else if($action === 'delete'){

                                $message = $message + ' deleted!';

                            } else if($action === 'email'){

                                $message = 'Email has been sent!';

                            } else {

                                $message = $message + ' saved!';
                            }

                            swal.fire({
                                title: 'Success',
                                text: $message,
                                type: 'success',

                            }).then((result) => {

                                if (result.value) {

                                    if($redirect){

                                        if($redirect == 'true'){

                                            window.location.reload();

                                        } else {

                                            window.location.href = $redirect;
                                        }


                                    } else {

                                        dataTable = $('.reload-table');

                                        if(dataTable.length){

                                            dataTable.trigger('click');
                                        }
                                    }
                                }
                            })



                        } else {

                            Swal.fire("Upssss!",  "Something went wrong!", "error");
                        }
                    }
                });
            }
        });
    });

    $('.logout').on('click', function(event){

        event.preventDefault();

        $("#logout-form").submit();
    });

});

(function($) {

    $.fn.scrollToError = function () {

        let error = $('.is-invalid');

        if (error.length) {

            return $('html, body').animate({

                scrollTop: error.first().parents('.form-group').offset().top

            }, 2000, function () {

                error.focus();
            });
        }
    }

})(jQuery);
