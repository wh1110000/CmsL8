@extends('admin::admin')

@section('title', __('media::general.media'))

@section('navigation')

    {{ Button::back(['admin.media.index']) }}

    {{ Button::add(['admin.media.show'] ) }}

@endsection

@section('content')

    <div class="row">

        @foreach($data as $file)

            <div class="col-6 col-lg-4 col-xl-3 mb-5 d-flex">

                {!!  Fields::fileFieldTemplate2($file)  !!}


            </div>
        @endforeach

        <div class="col-12">
            {{ $data->links() }}
        </div>
    </div>

@endsection
