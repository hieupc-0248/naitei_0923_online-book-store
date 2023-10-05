document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categorySelect = document.getElementById('categorySelect');
    const bookListElement = document.getElementById('bookList');
    const sortSelect = document.getElementById('sortSelect');

    function updateBookList(books) {
        bookListElement.innerHTML = '';

        books.data.forEach(book => {
            const bookElement = document.createElement('div');
            bookElement.classList.add('w-60', 'rounded-lg', 'overflow-hidden', 'shadow-lg', 'bg-white', 'flex', 'flex-col', 'items-center', 'mx-auto');
    
            const avtMedia = book.medias.find(media => media.type === "{{ config('app.avatar_media_type') }}");
            const imageUrl = avtMedia ? avtMedia.link : "{{ asset('storage/default.jpg') }}";
    
            bookElement.innerHTML = `
                <img class="w-32 h-32 object-cover" src="${imageUrl}" alt="${book.name}">
                <div class="px-6 py-4 text-center">
                    <div class="font-bold text-xl mb-2">${book.name}</div>
                    <p class="text-gray-700 text-base">$ ${book.price}</p>
                    <button class="text-white w-32 rounded-lg bg-blue-500 hover:bg-blue-700 focus:outline-none addToCartButton">
                        Add To Cart
                    </button>
                </div>
            `;

            bookListElement.appendChild(bookElement);
        });
    }

    function sendSearchRequest() {
        const searchTerm = searchInput.value.toLowerCase();
        const categoryId = categorySelect.value;
        const sortOption = sortSelect.value; 

        fetch(`/search?searchTerm=${searchTerm}&categoryId=${categoryId}&sort=${sortOption}`)
            .then(response => response.json())
            .then(data => {
                const books = data.books;
                updateBookList(books);
            })
            .catch(error => console.error('Error:', error));
    }

    function filterBooks() {
        sendSearchRequest();
    }

    function searchBooks() {
        sendSearchRequest();
    }

    categorySelect.addEventListener('change', filterBooks);
    searchInput.addEventListener('input', searchBooks);
    sortSelect.addEventListener('change', filterBooks);
});
