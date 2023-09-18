<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
<body class="w3-content" style="max-width:1300px">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Information') }}
        </h2>
    </x-slot>

    <!-- Second Grid: Work & Resume -->
    <div class="w3-row">
        <div class="w3-half w3-light-grey w3-center" style="min-height:800px" id="work">
            <div class="w3-padding-64">
                <h2>{{ $book->name }}</h2>
                <p>{{ __('Hình Minh Họa') }}</p>
            </div>
            <div class="w3-row">
                <div class="w3-half">
                    <img src="{{ asset('/storage/doraemon_1.webp') }}" style="width:100%">
                </div>
                <div class="w3-half">
                    <div class="w3-half">
                        <img src="{{ asset('/storage/doraemon_2.webp') }}" style="width:90%">
                    </div>
                    <div class="w3-half">
                        <img src="{{ asset('/storage/doraemon_3.jpg') }}" style="width:90%">
                    </div>
                    <div class="w3-half">
                        <img src="{{ asset('/storage/doraemon_4.webp') }}" style="width:90%">
                    </div>
                    <div class="w3-half">
                        <img src="{{ asset('/storage/doraemon_5.jpg') }}" style="width:90%">
                    </div>
                </div>
            </div>
        </div>
        <div class="w3-half w3-indigo w3-container" style="min-height:800px">
            <div class="w3-padding-64 w3-center">
                <h2>{{ __('Thông Tin Chi Tiết Sách') }}</h2>
                <div class="w3-container w3-responsive">
                    <table class="w3-table">
                        <tr>
                            <th class="w3-text-white">{{ __('Tên') }}</th>
                            <th class="w3-text-white">{{ $book->name }}</th>
                        </tr>
                        <tr class="w3-white">
                            <td>{{ __('Nội Dung') }}</td>
                            <td>{{ $book->description }}</td>
                        </tr>
                        <tr>
                            <td class="w3-text-white">{{ __('Giá Tiền') }}</td>
                            <td class="w3-text-white">{{ $book->price }}đ</td>
                        </tr>
                        <tr class="w3-white">
                            <td>{{ __('Nhà Xuất Bản') }}</td>
                            <td>{{ $book->publisher }}</td>
                        </tr>
                        <tr>
                            <td class="w3-text-white">{{ __('Năm Xuất Bản') }}</td>
                            <td class="w3-text-white">{{ $book->publisher_year }}</td>
                        </tr>
                        <tr class="w3-white">
                            <td>{{ __('Tác Giả') }}</td>
                            <td>{{ $book->author }}</td>
                        </tr>
                        <tr class="w3-hide-medium">
                            <td class="w3-text-white">{{ __('Số Trang') }}</td>
                            <td class="w3-text-white">{{ $book->page_nums }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Grid: Swing By & Contact -->
    <div class="w3-row" id="contact">
        <div class="w3-half w3-dark-grey w3-container w3-center" style="height:700px">
            <div class="w3-padding-64">
                <h1>{{ __('Liên Hệ') }}</h1>
            </div>
            <div class="w3-padding-64">
                <p>..for a cup of coffee, or whatever.</p>
                <p>Chicago, US</p>
                <p>+00 1515151515</p>
                <p>test@test.com</p>
            </div>
        </div>
        <div class="w3-half w3-teal w3-container" style="height:700px">
            <div class="w3-padding-64 w3-padding-large">
                <h1>{{ __('Bình Luận') }}</h1>
                <p class="w3-opacity">{{ __('Của Những Khách Đã Mua') }}</p>
                <form class="w3-container w3-card w3-padding-32 w3-white" action="/action_page.php" target="_blank">
                    @foreach ($book->reviews as $review)
                        <div class="w3-section">
                            <label>{{ $review->user->first_name . ' ' . $review->user->last_name }}</label>
                            <p>{{ $review->content }}</p>
                        </div>
                    @endforeach
                    <button type="submit" class="w3-button w3-teal w3-right">Send</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
