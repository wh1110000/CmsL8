@extends('admin::admin')

@section('navigation')

    @hasSection('navigation')

        @yield('navigation')

    @else

        @if(Str::endsWith(Route::currentRouteName(), '.index'))

            {{ Button::add($routePrefix.'show') }}

        @elseif(Str::endsWith(Route::currentRouteName(), '.show'))

            {{ Button::back($routePrefix.'index') }}

            {{ Button::add($routePrefix.'show') }}

            @if($post->exists)

                @if(\Route::has(Str::replaceFirst('admin.', '', $routePrefix.'.show')))

                    {{ Button::show([Str::replaceFirst('admin.', '', $routePrefix.'show'), $post, 'preview' => csrf_token()], true, false)->label('Preview on website')->render() }}

                @endif

            @endif
        @endif
    @endif

@endsection

@section('content')


    @isset($post)

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
    @endisset

    @hasSection('content')

        @yield('content')

    @else

        @if(Str::endsWith(Route::currentRouteName(), '.index'))

            {{ $data->render() }}

        @elseif(Str::endsWith(Route::currentRouteName(), '.show'))

            {{ Form::model($post) }}

                {{ Form::fields() }}

            {{ Form::close() }}
        @endif

    @endif

@endsection
