@extends('website::website')

@section('content')

    {{--@foreach($productCategories as $category)

        <h2>{{ $category->getTitle() }}</h2>

        @foreach($products as $product)

            <a href="{{ route('product.show', $product) }}">
                <span class="name small">{{ $product->getTitle() }}</span>
                <span class="number micro">{{ $product->getSku() }}</span>
            </a>

        @endforeach


    @endforeach--}}

@endsection

