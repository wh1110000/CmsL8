<x-modal title="Page" :result="$result" :closeBtnText="!$result ? 'Cancel' : 'Ok'">

    <x-slot name="resultSlot">

        <script type="text/javascript">
            $('.modal').on('hidden.bs.modal', function () {
                location.reload();
            });
        </script>

        <div class="alert alert-success">
            Record has been saved.
        </div>

    </x-slot>

    {{ Form::open(['route' => ['admin.nav.page.addTonav', $nav], 'data-async', 'method' => 'POST']) }}

        <table id="dtable" class="table table-bordered" style="width:100%">
            <thead>

                <tr>
                    <th>
                        <input type="text" class="form-control" placeholder="Search..." />
                    </th>

                    <th></th>
                </tr>

                <tr>
                    <th>Title</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($contents['data'] as $content)
                    <tr data-id="{{ $content['page'] }}">
                        <td width="60%">{!! $content['title'] !!}</td>

                        <td>{!! $content['page'] !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ Form::close() }}


    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success submit-modal-2" data-action="add">Save</button>
        @endif
    </x-slot>

</x-modal>

<script type="text/javascript">
    $(document).ready(function() {
        dtable = $('#dtable').DataTable({
            "autoWidth" : false,
            "select": true,
            "order": [[ 0, "asc" ]],
            "pageLength": -1,
            "columnDefs": [
                {
                    "searchable": true,
                    "orderable": true,
                    "targets": 0
                },
                {
                    "targets": 1,
                    "visible": false,
                    "searchable": false
                }
            ],
            "sDom":"t r",
            "drawCallback": function (settings, json) {
            }
        });

        $("#dtable thead th input").bindWithDelay( 'keyup change', function ()
        {
            dtable.column( $(this).parent().index()+':visible' ).search( this.value ).draw();
        }, 500);

        $("#dtable thead th select").bindWithDelay( 'change', function ()
        {
            dtable.column( $(this).parent().index()+':visible' ).search( this.value ).draw();
        },500);

        $('#dtable tbody').on( 'click', 'tr', function ()
        {
            $(this).toggleClass('bg-light');
        } );
    });

    $('.submit-modal-2').on('click', function () {
        var $form = $('form[data-async]');

        var data = $form.serializeArray();

        var dtableRows = dtable.rows( '.bg-light' ).data('1').toArray();
        //var selectedRows = JSON.stringify(dtable.rows( '.bg-light' ).data('1').toArray());

        var selectedRows = [];

        $.each(dtableRows, function (key, value) {
            selectedRows.push(value[1]);
        });

        data.push({name: 'action', value: $(this).attr('data-action')});

        data.push({name: 'data', value: selectedRows});

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: data,
            success: function(data, status) {
                $('.modal-content').html(data);
            }
        });

        return false;
    });

</script>
