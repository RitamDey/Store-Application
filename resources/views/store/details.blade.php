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
                    <select name="wishlist" id="wishlist"></select>
                    <input type="submit" value="Add to wishlist" class="btn btn-secondary">
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <script>
        $("#add-to-cart").on("click", function (event) {
            let product = this.value
            $.post({
                url: "{{ @route("cart.add") }}",
                data: { "product": product },
                dataType: "json"
            }).done(function(data) {
                console.log(data)
            }).fail(function( xhr, status, errorThrown ) {
                alert("Failed to add to cart")
            })
        });

        $("#wishlist-form").on("submit", function (event) {
            event.preventDefault();
            // Get the selected wishlist
            let wishlist = $("#wishlist option:selected").val()
            // Get the product id
            let item = $("#wishlist-form > input:hidden").val()

            $.post({
                url: "{{ @route("user.add_to_wishlist") }}",
                data: { "item": item, "wishlist": wishlist },
                dataType: "json"
            }).done(function(data) {
                if (!data.status)
                    alert(data.message)
                else
                    alert("Added to wishlist")
            }).fail(function(xhr, status, errorThrown) {
                alert("Failed to add to wishlist")
            })
        });

        {{--
            This function waits till the document is completely loaded and then fetches the user's wishlist
        --}}
        $(document).ready(function() {
            $("#wishlist").load("{{ @route("user.wishlists") }}")
        })
    </script>
@endsection
