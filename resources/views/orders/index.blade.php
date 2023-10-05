<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-800 leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full flex justify-center mx-auto sm:px-6 lg:px-8">
            <Table class="w-9/12">
                <thead class="bg-gray-400">
                    <tr>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('ID')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Created At')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Total')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Status')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Action')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($orders as $index => $order)
                        <tr class="border-b-4">
                            <td class="text-gray-900 text-center">{{ $order->id }}</td>
                            <td class="text-gray-900 text-center">{{ $order->created_at }}</td>
                            <td class="text-gray-900 text-center">$ {{ $order->total }}</td>
                            <td class="text-gray-900 text-center">
                                <div class="flex justify-center items-center">
                                    <div class="w-28">
                                        {{ $order->orderStatus }}
                                    </div>
                                    @if ($order->orderStatus !== 'shipped')
                                        <div class="mark-as-done-button" data-order-id="{{ $order->id }}">
                                            <x-primary-button class="bg-gray-700 text-gray-50">
                                                {{ __('Received') }}
                                            </x-primary-button>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-gray-900 text-center">
                                <a href="{{ route('orders.show', ['order' => $order->id]) }}">
                                    <x-primary-button class="bg-gray-400">
                                        {{ __('Detail') }}
                                    </x-primary-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </Table>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/order.js') }}"></script>
