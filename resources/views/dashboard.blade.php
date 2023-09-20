<x-app-layout>
    <div class="mb-4">
        <img class="w-full object-cover h-40" src="{{ asset('/storage/background.webp') }}" alt="Dashboard Cover">
    </div>

    <div class="my-4 flex justify-center items-center">
        <input type="text" class="p-2 border border-gray-300 rounded-lg w-1/2 mr-2" placeholder="Search..." id="searchInput">
        <select class="p-2 border border-gray-300 rounded-lg mr-2" id="categorySelect">
            <option value="all">{{ __('Category') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="p-2 bg-blue-500 text-white rounded-lg" id="searchButton">{{ __('Search') }}</button>
    </div>

    <div class="grid grid-cols-4 gap-5 justify-center mx-72" id="bookList">
        @foreach ($books as $book)
            <div class="w-60 rounded-lg overflow-hidden shadow-lg bg-white flex flex-col items-center mx-auto">
                <img class="w-32 h-32 object-cover" src="{{ asset('/storage/default.jpg') }}" alt="{{ $book->name }}">
                <div class="px-6 py-4 text-center">
                    <div class="font-bold text-xl mb-2">{{ $book->name }}</div>
                    <p class="text-gray-700 text-base">$ {{ $book->price }}</p>
                    <button class="text-white w-32 rounded-lg bg-blue-500 hover:bg-blue-700 focus:outline-none addToCartButton">
                        {{ __('Add To Cart') }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-8 flex justify-center items-center">
        {{ $books->links() }}
    </div>
</x-app-layout>

<script src="{{ asset('js/dashboard.js') }}" defer></script>
