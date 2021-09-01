$(document).ready(function() {

    $(document).on("click", ".btn-delete-menu", function(e) {

        e.preventDefault();

        var url = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this!',
            icon: 'error',
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            },
            dangerMode: true,
        }).then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {_method: 'delete'},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(result) {
alert('x');
                        if(result.success) {

                            swal({
                                type: 'error',
                                title: 'Deleted',
                                text: 'Success!',
                            }).then(function () {
                                if(result.redirect){

                                    window.location.href(result.redirect);

                                } else {

                                    location.reload();

                                }
                            });

                        } else {

                            swal('Oops!', 'Something went wrong');

                            swal("Oops! Something went wrong", {
                                icon: "error",
                            });
                        }
                    }
                });
            }
        });
    });

    $("#type").on("change", function() {

        let pageType = $('#type').val();

        let link = $(this).attr('data-href');

        $.ajax({
            url: link,
            type: 'POST',
            data: { page_type : pageType },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "html",
            success: function(result) {

                $('.page_type_form').html(result);
            }
        });
    });
});
