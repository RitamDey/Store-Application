@extends("base")

@section("content")
    <!-- Page Content -->
    <div class="container">
        <!-- Portfolio Item Heading -->
        <h1 class="my-4"> {{ $product->name }} </h1>

        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-md-8">
                <img class="img-fluid" src="{{ $product->url }}" alt="">
            </div>

            <div class="col-md-4">
                <h3 class="my-3">Product Description</h3>
                <p>{{ $product->description }}</p> <br/>
                <h3> Rs. {{ $product->price }}</h3>

                <form method="POST" id="cart-form">
                    @csrf
                    <input type="submit" value="Add to Cart">
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
