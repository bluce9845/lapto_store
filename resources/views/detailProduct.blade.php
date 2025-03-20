<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Detail Product' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body d-flex">
                        <div class="">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}.</p>
                            <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>

                        <div class="card ms-3 p-2" style="width: 20rem;" x-data="{
                            quantity: 1,
                            price: {{ $product->price }},
                            get totalPrice() { return this.quantity * this.price; }
                        }">
                            <form action="{{ route('order.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <ul>
                                    <li>
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name">
                                        @error('name')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </li>
                                    <li>
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email">
                                        @error('email')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </li>
                                    <li>
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number">
                                        @error('phone_number')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </li>
                                    <li>
                                        <label for="address">Addres</label>
                                        <input type="text" name="address" id="address">
                                        @error('address')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </li>
                                    <li>
                                        <label for="quantity">Total Order</label>
                                        <input type="number" name="quantity" id="quantity" x-model="quantity"
                                            min="1">
                                        @error('quantity')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </li>
                                    <li>
                                        <label for="total_price">Total Price</label>
                                        <input type="number" name="total_price" id="total_price" x-model="totalPrice"
                                            readonly>
                                        @error('total_price')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </li>
                                </ul>
                                <button class="btn btn-primary" type="submit">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
