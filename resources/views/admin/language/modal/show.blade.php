<x-modal :title="(__('multilanguage::general.languages'))" :result="$result">

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

    {{ Form::open(['url' => route('admin.language.manage'), 'data-async', 'multiple']) }}

    <div class="row">
        @foreach($languages as $language)
            <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="{{ $language->getId() }}" name="languages[]" class="custom-control-input" id="customCheck{{ $language->getId() }}" {{ $language->active ? 'checked="checked"' : '' }}>
                    <label class="custom-control-label" for="customCheck{{ $language->getId() }}">{{ $language->getName() }}</label>
                </div>
            </div>
        @endforeach
    </div>

    {{ Form::close() }}

    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success submit-modal text-white" data-action="add" data-style="zoom-in">Save</button>
        @endif
    </x-slot>

</x-modal>
