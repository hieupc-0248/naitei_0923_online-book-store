<x-admin-layout>
    <div class="py-12">
        <div class="w-full flex justify-center mx-auto sm:px-6 lg:px-8">
            <Table class="w-10/12">
                <thead class="bg-gray-400">
                    <tr>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('ID')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('User')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Created At')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Total')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Status')}}</th>
                        <th class="text-gray-900 text-center py-6 text-xl" scope="col">{{ __('Action')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    @foreach ($orders as $index => $order)
                    <tr class="border-b-4">
                        <td class="text-gray-900 text-base  text-center py-4">{{ $order->id }}</td>
                        <td class="text-gray-900 text-base text-center py-4">{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                        <td class="text-gray-900 text-base text-center py-4">{{ $order->created_at }}</td>
                        <td class="text-gray-900 text-base text-center py-4">$ {{ $order->total }}</td>
                        <td class="text-gray-900 text-center py-4 w-36">
                            <select data-order-id="{{ $order->id }}" class="w-32 block p-2 text-base text-gray-500 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach (config('app.order_status') as $status => $label)
                                    <option value="{{ $label }}" @if ($label==$order->status) selected @endif>{{ $status }}</option>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                @endforeach
                            </select>
                        </td>
                        <td class="text-gray-900 text-center py-4">
                            <a href="{{ route('orders.show_detail', ['order' => $order->id]) }}">
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
        <div class="my-8 flex justify-center items-center">
            {{ $orders->links() }}
        </div>
</x-admin-layout>
<script src="{{ asset('js/admin.js') }}"></script>
