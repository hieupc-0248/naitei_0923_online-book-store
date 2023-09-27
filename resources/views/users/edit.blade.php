<x-admin-layout>
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">{{ __('Edit User') }}</h2>

                <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="first_name" class="block font-bold mb-2">{{ __('First Name') }}</label>
                        <input id="first_name" type="text" class="form-input rounded-lg w-full @error('first_name') border-red-500 @enderror" name="first_name" value="{{ old('first_name', $user->first_name) }}" required autocomplete="first_name" autofocus>
                         @error('first_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                         @enderror
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block font-bold mb-2">{{ __('Last Name') }}</label>
                        <input id="last_name" type="text" class="form-input rounded-lg w-full @error('last_name') border-red-500 @enderror" name="last_name" value="{{ old('last_name', $user->last_name) }}" required autocomplete="last_name" autofocus>
                        @error('last_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-bold mb-2">{{ __('Email') }}</label>
                        <input id="email" type="text" class="form-input rounded-lg w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block font-bold mb-2">{{ __('Phone') }}</label>
                        <input id="phone" type="text" class="form-input rounded-lg w-full @error('phone') border-red-500 @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus>
                        @error('phone')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block font-bold mb-2">{{ __('Address') }}</label>
                        <input id="address" type="text" class="form-input rounded-lg w-full @error('address') border-red-500 @enderror" name="address" value="{{ old('address', $user->address) }}" required autocomplete="address" autofocus>
                        @error('address')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center justify-center w-full bg-blue-500 hover:bg-blue-700 h-10 rounded-lg">
                        <button type="submit" class="btn btn-primary text-gray-100">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
