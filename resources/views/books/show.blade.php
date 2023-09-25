<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Information') }}
        </h2>
    </x-slot>

    <div class="w-full flex justify-center mt-6">
        <div class="w-1/3 bg-white min-h-fit mr-6 rounded-lg flex flex-col p-6">
            <div id="large-image-container" class="flex justify-center">
                <img id="large-image" class="w-80 h-80" src="{{ asset($book->medias[0]->link) }}" alt="">
            </div>
            <div class="flex justify-center h-32 items-center">
                <div class="py-2 mt-4 w-10/12 bg-gray-200 flex justify-center">
                    @foreach ($book->medias as $media)
                    <img class="px-1 w-24 h-24" src="{{ asset($media->link) }}" alt="">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-5/12 bg-white min-h-fit p-6 flex flex-col rounded-lg">
            <div>
                <h1 class="text-4xl font-bold">{{ $book->name }}</h1>
            </div>
            <div class="my-4">
                <span class="text-3xl text-red-600 font-bold">${{ $book->price }}</span>
            </div>
            <div class="flex justify-start items-center py-1">
                <div>{{ __('Author') }}: </div>
                <p class="ml-3 text-lg font-semibold">{{ $book->author }}</p>
            </div>
            <div class="flex justify-start items-center py-1">
                <div>{{ __('Publisher') }}: </div>
                <p class="ml-3 mr-6 text-lg font-semibold">{{ $book->publisher }}</p>
            </div>
            <div class="flex justify-start items-center py-1">
                <div>{{ __('Publisher year') }}:</div>
                <div class="ml-3 mr-6 text-lg font-semibold">{{ $book->publisher_year }}</div>
                <div>{{ __('Page') }}: </div>
                <div class="ml-3 text-lg font-semibold">{{ $book->page_nums }}</div>
            </div>
            <div class="flex flex-col py-1">
                <div>{{ __('Category') }}:</div>
            </div>
            <div class="flex flex-col pt-1">
                <div>{{ __('Description') }}</div>
                <p class="ml-3 text-lg font-semibold">{{ $book->description }}</p>
            </div>
            <div>
                <form class="add-to-cart-form2">
                    @csrf
                    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="book" name="book" value="{{ $book->id }}">
                    <x-button class="mt-3 w-36 h-12 flex justify-center bg-red-700">{{ __('Add to cart') }}</x-button>
                </form>
                <div class="error-info" id="error-info"></div>
                <div class="success-info" id="success-info"></div>
            </div>
        </div>
    </div>

    <div class="w-full flex justify-center mt-6 pb-6">
        <div class="w-9/12 pt-6 bg-white min-h-fit p-6 rounded-lg">
            <span class="text-3xl font-bold mb-6 border-b-4 border-gray-500">{{ __('Review') }}</span>
            <div class="h-4"></div>
            <div id="review-list">
                <div class="mt-4"></div>
                <span class="text-3xl font-bold border-b-4 border-gray-500">{{ __('Create review') }}</span>
                <form>
                    @csrf
                    <div class="flex flex-col mt-6">
                        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="book" name="book" value="{{ $book->id }}">
                        <textarea name="content" id="content" cols="30" class="w-full rounded"></textarea>
                        <div class="flex items-center mt-2">
                            <svg class="w-6 h-6 text-yellow-500 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"></path>
                            </svg>
                            <select id="rating" name="rating" class="h-10 w-16 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-400 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="1">1</option>
                                @for ($i = 2; $i <= config('app.book_rating'); $i++) <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                        </div>
                        <x-button id="btn-add-update-review" class="mt-3 w-24 h-12 flex justify-center bg-gray-600">{{ __('Send') }}</x-button>
                        <div id="error-info">
                        </div>
                    </div>
                </form>
            </div>
            @foreach ($book->reviews->reverse() as $review)
            <div class="flex flex-col ml-5 mt-4 pb-4 h-40 border-t-4 border-gray-500">
                <div class="flex items-center">
                    <img class="w-12 h-12 rounded-full" src="{{ asset('/storage/user1.jpg') }}" alt="">
                    <label class="ml-4 text-xl will-change-transformtext-lg font-bold">{{ $review->user->last_name . ' ' . $review->user->first_name }}</label>
                </div>
                <p class="pl-16">{{ $review->created_at }}</p>
                <div class="pl-16 mb-2 flex">
                    @for ($i = 1; $i <= config('app.book_rating'); $i++) @if ($i <=$review->rating)
                        <svg class="w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"></path>
                        </svg>
                        @else
                        <svg class="w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11.479 1.712 2.367 4.8a.532.532 0 0 0 .4.292l5.294.769a.534.534 0 0 1 .3.91l-3.83 3.735a.534.534 0 0 0-.154.473l.9 5.272a.535.535 0 0 1-.775.563l-4.734-2.49a.536.536 0 0 0-.5 0l-4.73 2.487a.534.534 0 0 1-.775-.563l.9-5.272a.534.534 0 0 0-.154-.473L2.158 8.48a.534.534 0 0 1 .3-.911l5.294-.77a.532.532 0 0 0 .4-.292l2.367-4.8a.534.534 0 0 1 .96.004Z"></path>
                        </svg>
                        @endif
                        @endfor
                </div>
                <p name="content" class="w-full pl-16">
                    {{ $review->content }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/review.js') }}">
</script>
<script src="{{ asset('js/book.js') }}">
</script>
