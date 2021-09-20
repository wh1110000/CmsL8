<x-modal :title="( __('core::general.countries'))" :result="$result">

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

    {{ Form::open(['url' => route('admin.country.manage'), 'data-async', 'multiple']) }}

        <div class="row">
            @foreach($countries as $country)
                <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="{{ $country->getId() }}" name="countries[]" class="custom-control-input" id="customCheck{{ $country->getId() }}" {{ $country->active ? 'checked="checked"' : '' }}>
                        <label class="custom-control-label" for="customCheck{{ $country->getId() }}">{{ $country->getName() }}</label>
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

