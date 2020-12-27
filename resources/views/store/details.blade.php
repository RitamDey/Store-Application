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

                <button class="btn btn-primary" id="add-to-cart" value="{{ $product->id }}"> Add to cart </button>
                <hr/>
                <form id="wishlist-form">
                    <input type="hidden" value="{{ $product->id }}">
                    <label for="wishlist"></label>
                    <select name="wishlist" id="wishlist">
                        <option value="default">Default</option>
                        <option value="funky">Funky</option>
                    </select>
                    <input type="submit" value="Add to wishlist" class="btn btn-secondary">
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
