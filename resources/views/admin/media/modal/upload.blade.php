<x-modal title="Menu" :result="$result">

    <x-slot name="resultSlot">
        @isset($file)
           <script type="text/javascript">
               $('#{{ 'preview-'.request()->get('id') }}').attr('src', '{{ $file->getFile() }}');

               $('#{{ request()->get('id') }}').val('{{ $file->getId() }}');
           </script>
        @endisset

        <div class="alert alert-success">
            Record has been saved.
        </div>

    </x-slot>

    {{ Form::open(['url' => route('admin.media.upload.modal', ['id' => request()->get('id')]) , 'data-async', 'method' => 'POST', 'files' => true]) }}

        {{ Form::file('file', ['id' => 'file']) }}

    {{ Form::close() }}

    <script>
        function submit_form_file(action){
            let $form = $('form[data-async]');

            let data = new FormData();

            $.each($('#file')[0].files, function(i, file) {
                data.append('file', file);
            });

            data.append('action', action);

            data.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            $.ajax({
                url: $form.attr('action'),
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: $form.attr('method'),
                type: $form.attr('method'), // For jQuery < 1.9
                success: function(data){
                    $('.modal-content').html(data);
                }
            });

            return false;
        }
    </script>

    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success text-white" data-action="add" data-style="zoom-in" onclick="submit_form_file('add');">Save</button>
        @endif
    </x-slot>

</x-modal>