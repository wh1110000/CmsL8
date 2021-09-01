@if($languages->count() > 1)

    <style>
        header nav .language-select .list {
            width: 360px;
        }
        header nav .language-select .list ul li a {
            width: 100%;
        }
    </style>

    <div class="language-select">
        <a href="#">
            <span class="flag flag-icon flag-icon-{{ $currentLanguage->getIcon() }}"></span>
            {{ __('general.language') }}
        </a>

        <div class="list">
            <div class="arrow"></div>

            <span>{{ __('general.choose_your_country') }}</span>

            <ul>
                @foreach($languages as $language)

                    <li>
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ is_array($language->redirectTo) ? \Arr::first($language->redirectTo)['slug'] : $language->redirectTo }}">
                                    <span class="flag flag-icon flag-icon-{{ $language->getIcon() }}"></span>
                                    <span class="text-dark">{{ $language->getLabel() }}</span>
                                </a>
                            </div>

                            @if(is_array($language->redirectTo))
                                <div class="col-6 text-right">
                                    <div class="row">
                                        @foreach($language->redirectTo as $lang)
                                            <div class="col-6">
                                                <a href="{{ $lang['slug'] }}">{{ $lang['label'] }}</a>
                                            </div>
                                        @endforeach
                                        {{--<a href="{{ route(\Route::currentRouteName(), array_merge($params, ['locale' => 'ch_de'])) }}">France</a>--}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif