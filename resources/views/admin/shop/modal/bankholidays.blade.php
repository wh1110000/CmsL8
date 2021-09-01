<x-modal title="Bank holidays" :result="$result" :closeBtnText="!$result ? 'Cancel' : 'Ok'">

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



        {{ Form::model($shop, ['route' => ['admin.shop.modal.bankholidays', $shop, ($day ?? null)], 'data-async', 'method' => 'POST']) }}


        <div class="row">

                <div class="col-3">

                    {{ Form::text('label', $day->label, ['class' => 'form-control', 'placeholder' => 'Label']) }}

                </div>

                <div class="col-3">

                    {{ Form::text('date', $day->date, ['class' => 'form-control', 'placeholder' => 'Date']) }}

                </div>

                <div class="col-3">

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text"><i class="fas fa-lock-open"></i></span>

                        </div>

                        {{ Form::text('open_time', $day->open_time, ['class' => 'form-control', 'placeholder' => 'Open Time']) }}

                    </div>

                </div>

                <div class="col-3">

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text"><i class="fas fa-lock"></i></span>

                        </div>

                        {{ Form::text('close_time', $day->close_time, ['class' => 'form-control', 'placeholder' => 'Close Time']) }}

                    </div>

                </div>

            </div>

        {{ Form::close() }}

    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success submit-modal" data-action="add">Save</button>

        @endif

    </x-slot>

</x-modal>

