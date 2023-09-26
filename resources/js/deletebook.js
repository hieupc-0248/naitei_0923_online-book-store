document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".deleteBookButton");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const bookId = this.getAttribute("data-bookid");
            if (confirm("Are you sure you want to delete this book?")) {
                fetch(`/books/${bookId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                    .then((response) => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert("{{ trans('validation.book_delete_failed') }}");
                        }
                    })
                    .catch((error) => console.error("Error:", error));
            }
        });
    });
});
