<x-modal title="Menu" :result="$result">

    <x-slot name="resultSlot">

        @isset($file)

            <script type="text/javascript">

                $('#{{ 'preview-'.request()->get('id') }}').attr('src', '{{ $file->getFilePlaceholder() }}');

                $('#{{ request()->get('id') }}').val('{{ request('file') }}');

            </script>

        @endisset

        <div class="alert alert-success">
            Record has been saved.
        </div>

    </x-slot>

    {{ Form::open(['url' => route('admin.media.show.modal', ['id' => request()->get('id')]) , 'data-async', 'method' => 'POST']) }}

            <div class="row form-group product-chooser">
                @foreach($files as $file)
                    <div class="col-6 col-lg-4 mb-5 d-flex">
                        <div class="media-card product-chooser-item">
                            <img src="{{ $file->getFilePlaceholder() }}" alt="{{ $file->getFilename() }}">

                            <div class="header">
                                {{ $file->getFilename() }}

                                <input type="radio" name="file" value="{{ $file->getId() }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

    {{ Form::close() }}

    <script>
        $(function(){
            $('div.product-chooser').not('.disabled').find('div.product-chooser-item').on('click', function(){
                $(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('input[type="radio"]').prop("checked", true);
            });
        });

        function submit_form_file(action){
            let $form = $('form[data-async]');

            let data = new FormData();

            $.each($('#file-upload')[0].files, function(i, file) {
                data.append('csv', file);
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
            <button type="button" class="btn btn-success  submit-modal text-white" data-action="add" data-style="zoom-in">Select</button>
        @endif
    </x-slot>
</x-modal>
