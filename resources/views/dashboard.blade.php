<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('form.product') }}">+Add Product</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($products as $product)
                        <div class="card" style="width: 18rem;">
                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}.</p>
                                <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <a href="{{ route('detail.product', $product->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
