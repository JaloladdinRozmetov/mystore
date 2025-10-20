@extends('new.layouts.app')
@section('title', 'IDEALMETER — Products')

@section('content')

    <div class="container mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold mb-6">Products</h2>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($products->all() as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <a href="{{ route('products.show', ['locale'=>app()->getLocale(),'product' => $product]) }}">
                        <img src="{{ $product->media->first()?->getUrl('large') }}"
                             alt="{{ $product->translateAttribute('name') }}"
                             class="w-full h-48 object-cover">
                    </a>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold">
                            <a href="{{ route('products.show', ['locale'=>app()->getLocale(),'product' => $product]) }}">
                                {{ $product->translateAttribute('name') }}
                            </a>
                        </h3>
                        <p class="text-indigo-600 font-bold mt-2">
                            {{ $product->prices->first()->price->formatted }}
                        </p>
                        <form action="#" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="w-16 text-center border rounded">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>

@endsection
