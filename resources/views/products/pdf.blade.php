
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
<h1>Product Details</h1>

<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Price:</strong> ${{ $product->price }}</p>
<p><strong>Description:</strong> {{ $product->description }}</p>
<p><strong>Product Status:</strong> {{ $product->product_status }}</p>
<p><strong>Shipping Cost:</strong> ${{ $product->shipping_cost }}</p>

{{--@if($product->feature_image)
    <img src="{{ storage_path('app/'.$product->feature_image_path) }}" style="width: 200px; height: 200px">
@endif--}}

</body>
</html>
