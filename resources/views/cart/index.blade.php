<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
        @if (count($cartItems) > 0)
            <div class="bg-white dark:bg-gray-50 shadow-lg rounded-lg">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-50 dark:bg-gray-900 ">
                        <tr>
                            <th class="text-center px-6 py-4 text-left text-lg font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __("Image") }}
                            </th>
                            <th class="text-center px-6 py-4 text-left text-lg font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __("Name") }}
                            </th>
                            <th class="text-center px-6 py-4 text-left text-lg font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __("Quantity") }}
                            </th>
                            <th class="text-center px-6 py-4 text-left text-lg font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __("Price") }}
                            </th>
                            <th hidden class="text-center px-6 py-3 text-left text-lg font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{ __("Total") }}
                            </th>
                            <th class="relative px-6 py-3 text-gray-500 dark:text-red-100">
                                <span class="sr-only uppercase"> {{ __("Delete") }}
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-slate-50 divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($cartItems as $cartItem)
                            <tr class="cart-item-wrap">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex justify-center">
                                        <img src="{{ asset('/storage/default.jpg') }}" class="w-32 h-32 object-cover">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xl font-medium text-gray-500 dark:text-gray-900">
                                    <div class="flex justify-center">
                                        {{ $cartItem->book->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xl text-gray-500 dark:text-gray-900">
                                    <div class="flex items-center justify-center quantity-group">
                                        <button class="btn-decrease px-2 py-1 bg-blue-500 text-dark rounded-l hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500">-</button>
                                        <span id="quantity" data-id="{{ $cartItem->id }}" data-book-price="{{ $cartItem->book->price }}" class="px-4">{{ $cartItem->quantity }}</span>
                                        <button class="btn-increase px-2 py-1 bg-blue-500 text-dark rounded-r hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500">+</button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xl text-gray-500 dark:text-gray-900">
                                    <div class="flex justify-center">
                                        ${{ $cartItem->book->price }}
                                    </div>
                                </td>
                                <td hidden id="total-display" class="px-6 py-4 whitespace-nowrap text-base text-gray-500 dark:text-gray-900">
                                    <div class="flex justify-center">
                                        ${{ $cartItem->quantity * $cartItem->book->price }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-base font-medium">
                                    <form action="{{ route('carts.destroy', ['cart' => $cartItem->id]) }}" method="POST" class="flex justify-center">
                                        @csrf
                                        @method('DELETE')
                                        <x-button> {{ __('Delete') }}
                                        </x-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-8 px-6 py-4 border-t-4 border-gray-500">
                    <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-900 uppercase">{{ __("User information") }}</h2>
                    <div class="mt-4">
                        <label for="name" class="block text-gray-700 dark:text-gray-700 font-medium">{{ __("Fullname") }}</label>
                        <input disabled type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-300 dark:border-gray-700" required value="{{ $user->last_name }} {{ $user->first_name }}">
                    </div>
                    <div class="mt-4">
                        <label for="phone" class="block text-gray-700 dark:text-gray-700 font-medium">{{ __("Phone") }}</label>
                        <input disabled type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-300 dark:border-gray-700" required value="{{ $user->phone }}">
                    </div>
                    <div class="mt-4">
                        <label for="address" class="block text-gray-700 dark:text-gray-700 font-medium">{{ __("Address") }}</label>
                        <input disabled type="text" id="address" name="address" class="mt-1 p-2 w-full border rounded-md dark:bg-gray-300 dark:border-gray-700" required value="{{ $user->address }}">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-100 dark:bg-gray-400">
                    {{ __("Total:") }}
                    <p id="cart-total" class="text-2xl font-bold text-red-600 dark:text-red-600"></p>
                </div>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="total1" name="total">
                    <div class="px-6 py-4 text-right bg-gray-50 dark:bg-gray-500">
                        <x-button class="ml-4">
                            {{ __("Create") }}
                        </x-button>
                    </div>
                </form>
            </div>
        @else
            <p class="text-4xl dark:text-gray-900 mt-4">{{ __("Cart is empty") }} !</p>
        @endif
    </div>
    <script src="{{ asset('js/cart.js') }}">
    </script>
</x-app-layout>
