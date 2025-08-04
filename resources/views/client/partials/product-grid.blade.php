<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-4">
    @foreach ($products as $product)
        <x-product-card :product="$product" />
    @endforeach
</div>
