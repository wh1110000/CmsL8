@extends('website::website')

@section('content')

    {{--
    <div class="row">

        <div class="col-12">

            <h2 class="mb-4">{{ $shop->getName() }}</h2>

        </div>

        <div class="col-8">

            {{ Html::image($shop->getMedia('thumbnail'), config('app.name').' Logo') }}

            <p class="mt-4">{!! $shop->getDescription() !!}</p>

        </div>

        <div class="col-4">

            <h4>Opening Hours</h4>

            <table class="mb-5">

                @foreach ($shop->getOpeningHours()['weekdays'] as $day)

                    <tr>
                        <td>{{ $day['label'] }}: </td>
                        <td>{{ $day['open_formatted'] }} - {{ $day['close_formatted'] }}</td>
                    </tr>

                @endforeach

            </table>

            <h4>Contact Details</h4>

            <div class="my-3">

                <strong>{!! $shop->getManagerName() !!}</strong>

            </div>

            <div>

                <ul class="list-unstyled">

                    @if($shop->getEmail())

                        <li>

                            <i class="fas fa-envelope-open"></i> {{ $shop->getEmail() }}

                        </li>

                    @endif

                    @if($shop->getPhone())

                        <li>

                            <i class="fas fa-phone"></i> {{ $shop->getPhone() }}

                        </li>

                    @endif

                    @if($shop->getFax())

                        <li>

                            <i class="fas fas fa-phone"></i> {{ $shop->getFax() }}

                        </li>

                    @endif

                    @if($shop->getUrl())

                        <li>

                            <a href="{{ $shop->getUrl(true) }}" target="_blank">

                                <i class="fas fa-link"></i> {{ $shop->getUrl() }}

                            </a>

                        </li>

                    @endif

                </ul>

            </div>

        </div>

        @if($shop->getTestimonials())

            <div class="col-12 mt-5">

                <h4>Testimonials</h4>

                <div class="row my-5">

                    @foreach($shop->getTestimonials() as $testimonial)

                        <div class="col-4">

                            <div class="card w-100">

                                <div class="card-body">

                                    <h5>{{ $testimonial->getFullName() }}</h5>

                                    <p>{!! $testimonial->getMessage() !!}</p>

                                    <div class="text-muted"><small>{{ $testimonial->getDate('created_at') }}</small></div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>--}}

@endsection
