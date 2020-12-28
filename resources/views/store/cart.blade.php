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
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Total</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    <a href="{{ @route("store.product", $product->get("id")) }}" class="text-dark d-inline-block align-middle">{{ $product->get('name') }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>Rs {{ $product->get('price') }}</strong></td>
                                    <td class="border-0 align-middle"><strong>{{ $product->get('quantity') }}</strong></td>
                                    <td class="border-0 align-middle"><strong>{{ $product->get('item_total') }}</strong></td>
                                    <td class="border-0 align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    Grand Total
                                                </h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"></td>
                                    <td class="border-0 align-middle"></td>
                                    <td class="border-0 align-middle"><strong>{{ $total }}</strong></td>
                                    <td class="border-0 align-middle"><a href="{{ @route('user.checkout') }}" class="btn btn-primary">Checkout</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
