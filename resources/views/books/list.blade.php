<x-admin-layout>
    <div class="mb-4">
        <img class="w-full object-cover h-40" src="{{ asset('/storage/background.webp') }}" alt="Dashboard Cover">
    </div>

    <div class="my-8 mx-32 text-right">
        <a href="{{ route('books.create') }}" class="text-white bg-green-500 hover:bg-green-700 py-2 px-4 rounded-lg">
            {{ __('Create Book') }}
        </a>
    </div>
    <div class="grid grid-cols-4 gap-5 justify-center mx-72" id="bookList">
        @foreach ($books as $book)
            <div class="w-60 rounded-lg overflow-hidden shadow-lg bg-white flex flex-col items-center mx-auto">
                @php
                    $media = $book->medias->first();
                    $imageUrl = $media ? asset(Storage::url($media->link)) : asset('storage/default.jpg');
                @endphp
                <img class="w-32 h-32 object-cover" src="{{ $imageUrl }}" alt="{{ $book->name }}">
                <div class="px-6 py-4 text-center">
                    <div class="font-bold text-xl mb-2">{{ $book->name }}</div>
                    <p class="text-gray-700 text-base">$ {{ $book->price }}</p>
                    <button class="text-black w-32 rounded-lg bg-yellow-500 hover:bg-yellow-700 focus:outline-none" data-bookid="{{ $book->id }}">
                        <a href="{{ route('books.edit', $book) }}">{{ __('Edit Book') }}</a>
                    </button>
                    <button class="text-white w-32 rounded-lg bg-red-500 hover:bg-red-700 focus:outline-none deleteBookButton" data-bookid="{{ $book->id }}">
                        {{ __('Delete Book') }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-8 flex justify-center items-center">
        {{ $books->links() }}
    </div>
</x-admin-layout>

<script src="{{ asset('js/deletebook.js') }}" defer></script>
