<x-modal :title="$file->getFilename()" :result="$result">

    <x-slot name="resultSlot">
        <div class="alert alert-success">
            Record has been saved.
        </div>

        <script type="text/javascript">

        $('.modal').on('hidden.bs.modal', function () {

        location.reload();
        });

        </script>

    </x-slot>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ $file->getFilePlaceholder() }}" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="">
        </div>

        <div class="col-md-6">
            {{ Form::model($file, ['route' => ['admin.media.edit.modal', $file], 'method' => 'POST', 'data-async']) }}

                {{ Form::fields() }}

                    <div class="mt-4">
                        <p>Size: {{ $file->getSize() }}</p>

                        <p>Dimensions: {{ $file->getDimensions() }}</p>

                        <p>Created at: {{ $file->getDate('created_at') }}</p>

                        <p>Updated at: {{ $file->getDate('updated_at') ?? '---' }}</p>
                    </div>
            {{ Form::close() }}
        </div>
    </div>

    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success  submit-modal text-white" data-action="add" data-style="zoom-in">{{ __('cms::general.save') }}</button>
        @endif
    </x-slot>

</x-modal>
