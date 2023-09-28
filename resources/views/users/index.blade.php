<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("User list") }}
                </div>
            </div>
            <x-nav-link href="{{  route('users.create')  }}">
                <x-primary-button class="mt-4 text-gray-100 bg-green-500">
                    {{ __('Create new user') }}
                </x-primary-button>
            </x-nav-link>
            <table class="table w-full">
                <thead>
                    <tr>
                        <th class="text-gray-900 dark:text-gray-900 text-center" scope="col">{{ __('#') }}</th>
                        <th class="text-gray-900 dark:text-gray-900 text-center" scope="col">{{ __('Name') }}</th>
                        <th class="text-gray-900 dark:text-gray-900 text-center" scope="col">{{ __('Email') }}</th>
                        <th class="text-gray-900 dark:text-gray-900 text-right" scope="col" style="padding-right: 8rem">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <th class="text-gray-900 dark:text-gray-900 text-center" scope="row">{{  ++$index  }}</th>
                            <td class="text-gray-900 dark:text-gray-900 text-center">{{  $user->first_name . " " . $user->last_name}}</td>
                            <td class="text-gray-900 dark:text-gray-900 text-center">{{  $user->email  }}</td>
                            <td class="text-gray-900 dark:text-gray-900 text-right">
                                <x-nav-link href="{{  route('users.show', ['user' => $user->id])  }}">
                                    <x-primary-button class="mt-4 text-gray-100 bg-green-500 w-28 items-center justify-center">
                                        {{ __('Show') }}
                                    </x-primary-button>
                                </x-nav-link>
                                <x-nav-link href="{{  route('users.edit', ['user' => $user->id])  }}">
                                    <x-primary-button class="mt-4 text-gray-100 bg-yellow-500 w-28 items-center justify-center">
                                        {{ __('Edit') }}
                                    </x-primary-button>
                                </x-nav-link>
                                <form action="{{  route('users.destroy', ['user' => $user->id])  }}" method="post" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                    <x-primary-button class="mt-4 text-gray-100 bg-red-500 w-28 items-center justify-center">
                                        {{ __('Delete') }}
                                    </x-primary-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
