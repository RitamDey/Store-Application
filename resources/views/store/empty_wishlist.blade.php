@extends("base")


@section("content")
<div class="jumbotron text-center">
    <br/><br/>
    <h1 class="display-3"> Your wishlist is empty! </h1>
    {{-- 
    <p class="lead">
        <strong> {{ $order_id }} </strong>
    </p> --}}
    <hr>
    
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="{{ @route("store.index") }}" role="button">
            Add some items!
        </a>
    </p>
</div>
@endsection