<x-modal title="Weekdays" :result="$result" :closeBtnText="!$result ? 'Cancel' : 'Ok'">

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


    {{ Form::model($shop, ['route' => ['admin.shop.modal.weekdays', $shop], 'data-async', 'method' => 'POST']) }}

        @for($day = 7; $day >= 1; $day-- )

            <div class="row px-3">

                <div class="col-2">

                    {{ $shop->getDayOfWeek($day, true) }}

                </div>

                <div class="col-4">

                    {{ Form::text('days['.$shop->getDayOfWeek($day)->day.'][label]', $shop->getDayOfWeek($day)->label, ['class' => 'form-control', 'placeholder' => 'Label']) }}

                </div>

                <div class="col-3">

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text"><i class="fas fa-lock-open"></i></span>

                        </div>

                        {{ Form::text('days['.$shop->getDayOfWeek($day)->day.'][open_time]', $shop->getDayOfWeek($day)->open_time, ['class' => 'form-control', 'placeholder' => 'Open Time']) }}

                    </div>

                </div>

                <div class="col-3">

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text"><i class="fas fa-lock"></i></span>

                        </div>

                        {{ Form::text('days['.$shop->getDayOfWeek($day)->day.'][close_time]', $shop->getDayOfWeek($day)->close_time, ['class' => 'form-control', 'placeholder' => 'Close Time']) }}

                    </div>

                </div>

                <div class="line"></div>

            </div>

        @endfor

    {{ Form::close() }}

    <x-slot name="buttons">
        @if(!$result)
            <button type="button" class="btn btn-success submit-modal" data-action="add">Save</button>
        @endif

    </x-slot>

</x-modal>
