<x-modal title="Page" :result="$result">

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

    {{ Form::model($page, ['route' => ['admin.nav.page.edit', $page] , 'data-async', 'method' => 'POST']) }}

        {{ Form::fields() }}

    {{ Form::close() }}

    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success submit-modal text-white" data-action="add" data-style="zoom-in">Save</button>
        @endif
    </x-slot>

</x-modal>
