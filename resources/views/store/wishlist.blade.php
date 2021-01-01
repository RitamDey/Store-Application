@extends("base")


@section("content")
<div style="text-align: center;"><h1> Your Wislists </h1></div>
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
                                    <div class="p-2 px-3 text-uppercase">Order Number</div>
                                </th>
                                <th scope="col" class="border-0 bg-light"></th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Total Items</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Last Modified</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">View</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wishlists as $wishlist)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">{{ $wishlist->name }}</h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"></td>
                                    <td class="border-0 align-middle">
                                        <strong>Wishlist total items</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <strong>{{ $wishlist->updated_at->diffForHumans() }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <a href="#" class="btn btn-primary">
                                            Details
                                        </a>
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
@endsection
