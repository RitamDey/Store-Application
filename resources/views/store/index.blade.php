@extends('base')

@section ('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                {{-- Loop over the entire products array and fill-in the data to make products cards --}}
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ $product->url }}" alt="{{ $product->name }} Image"/>

                            <div class="card-body">
                                <p class="card-text"> {{ $product->name }} </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ @route("store.product", $product->id) }}" type="button"
                                           class="btn btn-sm btn-outline-secondary">View</a>
                                    </div>
                                    <small class="text-muted">Rs. {{ $product->price }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
@endsection
