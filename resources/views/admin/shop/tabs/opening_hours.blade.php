
    <div class="row">

        <div class="col-sm-6">

           {{  Html::block('open', __('shops::general.week'), Button::edit(['admin.shop.modal.weekdays', $post], true, false)->modal()->render(true)) }}

                @foreach($post->getOpeningHours()['weekdays'] as $day)

                    {{ \Fields::text('from')->label($day['label'])->value([[$day['open'], '<i class="fas fa-lock-open"></i>'], [$day['close'], '<i class="fas fa-lock"></i>']])->disabled()->add() }}

                @endforeach

            {{ Html::block('close') }}

        </div>

        <div class="col-sm-6">

            {{ Html::block('open', __('shops::general.bank_holidays'), Button::add(['admin.shop.modal.bankholidays', $post], true, false)->modal()->render(true)) }}

                @forelse($post->getOpeningHours()['bank_holidays'] as $day)

                    <div class="row">

                        <div class="col-8">

                            {{ \Fields::text('from')->label($day['label'])->value([[$day['open'], '<i class="fas fa-lock-open"></i>'], [$day['close'], '<i class="fas fa-lock"></i>']])->disabled()->add() }}

                        </div>

                        <div class="col-4 align-self-end">

                            {{ Button::edit(['admin.shop.modal.bankholidays', $post, $day['id']], true, false)->modal()->render() }}

                            {{ Button::delete(['admin.shop.delete.opening_times', $post, $day['id']], true, false)->modal()->render() }}
                        </div>

                    </div>

                @empty

                    No Records

                @endforelse

            {{ Html::block('close')  }}

        </div>

    </div>
