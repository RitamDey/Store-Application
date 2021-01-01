@extends("base")

@section("content")
<style>
body {
    min-height: 100vh;
}
</style>
<div class="px-4 px-lg-0">
    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantity</div>
                                </th>
                                <th scope="col" class="border-0 bg-light"></th>
                                <th scope="col" class="border-0 bg-light"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                                <th scope="row" class="border-0">
                                    <div class="p-2">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0">
                                                <a href="{{ @route("store.product", $item->product-id) }}" class="text-dark d-inline-block align-middle">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </th>
                                <td class="border-0 align-middle">
                                    <strong>
                                        Rs {{ $item->product->price }}
                                    </strong>
                                </td>
                                <td class="border-0 align-middle">
                                    <strong>{{ $item->added_at->diffForHumans() }}</strong>
                                </td>
                                <td class="border-0 align-middle">
                                    <button onclick="cart(this, {{ $item->product->id }})">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </td>
                                <td class="border-0 align-middle">
                                    <button onclick="remove(this, {{ $this->product->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function remove(remove_btn, product) {
        $.post({
            url: "{{ @route("cart.remove") }}",
            data: { "product": product },
            dataType: "json"
        }).done(function(data) {
            if (data.status) {
                // The passed element is the remove button. It's grand parent is the table row
                // of the product in question. Navigate to it and remove it from DOM
                let row = remove_btn.parentElement.parentElement
                row.remove()
                // Get the current total and subtract the price as returned by the endpoint
                // and update the DOM to reflect the accurate price
                let total = parseFloat($("#total").text())
                total -= data.cost
                $("#total").text(total)

                // When the cart value reaches 0, reload the entire window.
                // This will ensure that the empty cart UI is displayed
                if (total <= 0)
                    window.location.reload()
            }
            else {
                alert("Can't remove item from cart")
            }
        }).fail(function( xhr, status, errorThrown ) {
            alert("Failed to remove from cart")
        })
    }

    function decrease(minus_btn, product) {
        $.post({
            url: "{{ @route("cart.decrease") }}",
            data: { "product": product },
            dataType: "json"
        }).done(function(data) {
            if (data.status) {
                update_row(minus_btn, data.price, true)
                let total = parseFloat($("#total").text())
                total -= data.price
                $("#total").text(total)
            }
            else {
                alert("Can't decrease quantity")
            }
        }).fail(function( xhr, status, errorThrown ) {
            alert("Failed to decrease quantity")
        })
    }

    function increase(add_btn, product) {
        $.post({
            url: "{{ @route("cart.increase") }}",
            data: { "product": product },
            dataType: "json"
        }).done(function(data) {
            if (data.status) {
                update_row(add_btn, data.price, false)
                let total = parseFloat($("#total").text())
                total += data.price
                $("#total").text(total)
            }
            else {
                alert("Can't increase quantity")
            }
        }).fail(function(xhr, status, errorThrown) {
            alert("Failed to increase quantity")
        })
    }
</script>
@endsection
