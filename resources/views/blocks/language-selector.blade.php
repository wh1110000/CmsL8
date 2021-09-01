@if($langs = getActiveLanguages())

    @if($langs->count() > 1)
    @php

        $currentLanguage = getLanguage('current');

        $params = \Route::current()->parameters;

    @endphp

    <a href="#" class="{{ $currentLanguage->getLanguageCode() }}-flag">{{ $currentLanguage->getLabel() }}</a>
    <div class="language-menu">
        <ul>
            @foreach(getActiveLanguages([$currentLanguage->getCode()]) as $language)

                @php

                    $params['locale'] = $language->getCode();

                @endphp

                <li><a href="{{ route(\Route::currentRouteName(), $params) }}" style="background-image: url('{{ asset('/images/icons/' . $language->getLanguageCode() . '-flag.svg') }}')">{{ $language->getLabel() }}</a></li>
            @endforeach
        </ul>
    </div>
@endif
@endif
