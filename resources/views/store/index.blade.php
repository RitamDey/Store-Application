@foreach ($products as $product)
    {{ $product->name }} <br/>
    {{ $product->price }} <br/>
@endforeach
