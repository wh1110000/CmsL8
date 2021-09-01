@extends('admin::admin')

@section('content')

    @if($post->hasMultilanguage() && $post->exists)
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="{{ request()->url() }}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ request()->has('translations') ? strtoupper(request()->get('translations') /*\Language::where('code', request()->get('translations'))->first()->getLabel()*/) : 'Default' }}
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{ request()->url() }}">Default</a>
                @foreach(app('multilanguage')->getAll([app('SettingsManager')->get('DEFAULT_LANGUAGE')]) as $language)
                    <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['translations' => $language->getCode()]) }}">{{ strtoupper($language->getLabel()) }}</a>
                @endforeach
            </div>
        </div>

        @if(request()->get('translations'))
            <div class="alert alert-info my-4" role="alert">
                <h3>You are in translation mode</h3>

                <p>Current language is {{ strtoupper(request()->get('translations')/*\Language::where('code', request()->get('translations'))->first()->getLabel()*/) }}</p>

                <p><a href="{{ request()->url() }}">Back to default</a></p>
            </div>
        @endif
    @endif

    @yield('content')

@overwrite
