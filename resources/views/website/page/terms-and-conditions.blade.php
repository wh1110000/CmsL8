@extends('website::website')

@section('content')

    <h2>{{ $page->getTitle() }}</h2>

    {!! $page->getContent() !!}

    @if(auth()->check())

        {{--!! Form::open(['url'=>subdomainRoute('website.account.terms-and-conditions'), 'data-async', 'formRequest' => 'Modal\TermsAndConditions']) !!}

        <div class="row my-5">

            <div class="col-12">

                @if(!$user->getEmail())

                    {{ Form::formGroup('email') }}

                @endif

                @if(!$user->company_name)

                    {{ Form::formGroup('name') }}

                @endif

                @if(!$user->terms_and_conditions_accepted)

                    <div class="form-group{{ $errors->has('terms_and_conditions_accepted') ? ' has-error' : '' }}">

                        <div class="custom-control custom-checkbox">

                            {{ Form::checkbox('terms_and_conditions_accepted', true, null, ['id'=>'terms_and_conditions_accepted', 'class' => 'custom-control-input'. ($errors->has('terms_and_conditions_accepted') ? ' is-invalid' : '' )]) }}

                            <label class="custom-control-label" for="terms_and_conditions_accepted">I agree</label>

                        </div>

                        @if ($errors->has('terms_and_conditions_accepted'))

                            <div class="invalid-feedback">

                                <strong>{{ $errors->first('terms_and_conditions_accepted') }}</strong>

                            </div>

                        @endif

                    </div>

                @endif

            </div>

        </div>

        {{ Form::submit() }}

        {!! Form::close() !!}--}}

    @endif

@endsection
