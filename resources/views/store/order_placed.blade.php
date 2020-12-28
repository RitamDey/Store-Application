@extends("base")


@section("content")
<div class="jumbotron text-center">
    <h1 class="display-3">Thank You!</h1>
    
    <p class="lead">
        Your order ID is<strong> {{ $order_id }}</strong>
    </p>
    <hr>
    
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="{{ @route("dasboard") }}" role="button">
            Continue to dasboard
        </a>
    </p>
</div>
@endsection