<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Information') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">{{ __('User Information') }}</h2>
                    <div class="mb-4">
                        <label for="first_name" class="block font-bold mb-2">{{ __('First Name') }}</label>
                        <input id="first_name" type="text" class="form-input rounded-lg w-full" name="first_name" value="{{ old('first_name', $user->first_name) }}" required autocomplete="first_name" autofocus disabled>
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="block font-bold mb-2">{{ __('Last Name') }}</label>
                        <input id="last_name" type="text" class="form-input rounded-lg w-full" name="last_name" value="{{ old('last_name', $user->last_name) }}" required autocomplete="last_name" autofocus disabled>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block font-bold mb-2">{{ __('Email') }}</label>
                        <input id="email" type="text" class="form-input rounded-lg w-full" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus disabled>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block font-bold mb-2">{{ __('Phone') }}</label>
                        <input id="phone" type="text" class="form-input rounded-lg w-full" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus disabled>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block font-bold mb-2">{{ __('Address') }}</label>
                        <input id="address" type="text" class="form-input rounded-lg w-full" name="address" value="{{ old('address', $user->address) }}" required autocomplete="address" autofocus disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
