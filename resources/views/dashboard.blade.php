@extends("base")


@section("content")
<div style="text-align: center;"><h1> Your Purchases </h1></div>
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
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Total Cost</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Total Items</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Order Date</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">View</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bills as $bill)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0">
                                                    Order Number #{{ $bill->id }}
                                                </h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle">
                                        <strong>Rs {{ $bill->total_cost }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <strong>{{ $bill->total_items }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <strong>{{ $bill->created_at->diffForHumans() }}</strong>
                                    </td>
                                    <td class="border-0 align-middle">
                                        <a href="{{ @route("user.bill", $bill->id) }}" class="btn btn-primary">
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
