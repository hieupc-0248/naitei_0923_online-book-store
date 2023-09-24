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
                            <td class="text-gray-900 text-center">{{ $order->status }}</td>
                            <td class="text-gray-900 text-center">
                                <a href="{{ route('orders.show', ['order' => $order->id]) }}">
                                    <x-primary-button>
                                        {{ __('Detail') }}
                                    </x-primary-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </Table>
        </div>
        <div class="my-8 flex justify-center items-center">
            {{ $orders->links() }}
        </div>z
    </div>
</x-app-layout>
