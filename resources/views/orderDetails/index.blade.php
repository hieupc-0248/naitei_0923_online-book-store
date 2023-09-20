<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between font-bold text-3xl text-gray-800 leading-tight">
            <p>
                {{ __('Order Detail') }} : {{$order->id}}
            </p>
            <p>
                {{ __('Created At')}} : {{ $order->created_at }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full flex justify-center mx-auto sm:px-6 lg:px-8">
            <Table class="w-8/12">
                <thead class="bg-gray-400">
                    <tr>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">#</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Book')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Quantity')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Price')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($order->orderDetails as $index => $order_detail)
                        <tr class="border-b-4">
                            <td class="text-gray-900 text-center py-4">{{++$index}}</td>
                            <td class="text-gray-900 text-center py-4"><a href="/books/{{ $order_detail->book->id }}">
                                    {{ $order_detail->book->name }}
                                </a></td>
                            <td class="text-gray-900 text-center py-4">{{ $order_detail->quantity }}</td>
                            <td class="text-gray-900 text-center py-4">$ {{ $order_detail->book->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </Table>
        </div>
    </div>
</x-app-layout>
