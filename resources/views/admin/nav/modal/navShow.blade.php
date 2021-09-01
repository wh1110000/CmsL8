<x-modal title="Nav" :result="$result">

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

    {{ Form::model($nav, ['route' => array_filter(['admin.nav.nav.show', $nav]) , 'data-async', 'method' => 'POST']) }}

        {{ Form::fields() }}

    {{ Form::close() }}


    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success submit-modal text-white" data-action="add" data-style="zoom-in">Save</button>
        @endif
    </x-slot>

</x-modal>
