@extends('admin::admin')

@section('title', __('cms::general.dashboard'))

@section('content')

    {{--<section class="dashboard-counts section-padding">
        <div class="container-fluid">
            <div class="row">
                @foreach($blocks as $label => $block)
                    <div class="col-3">
                        <div class="card text-white bg-dark mb-3">
                            <div class="card-header">{{ $label }}</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ implode(' / ', $block) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>--}}

    <!-- Updates Section -->
    {{--<section class="mt-30px mb-30px">
        <div class="container-fluid">
            <div class="row">
                @foreach($cards as $title => $card)
                    <div class="col-lg-4 col-md-12">
                        @foreach($card as $data)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $title }}</h5>
                                <p class="card-text">{{-- $data->getTitle() -}}</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>

                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>--}}

@endsection
