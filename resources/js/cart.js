function updateCartTotal() {
    const cartItems = document.querySelectorAll(".cart-item-wrap");
    let cartTotal = 0;

    cartItems.forEach(function (cartItem) {
        const quantityElement = cartItem.querySelector("#quantity");
        const price = parseFloat(
            quantityElement.getAttribute("data-book-price")
        );
        const quantity = parseInt(quantityElement.innerText);
        const totalElement = cartItem.querySelector("#total-display");
        const itemTotal = price * quantity;
        totalElement.innerText = "$" + itemTotal;
        cartTotal += itemTotal;
    });

    const cartTotalElement = document.getElementById("cart-total");
    cartTotalElement.innerText = "$" + cartTotal;

    const totalInput = document.getElementById("total1");
    totalInput.value = cartTotal;
}

const decreaseButtons = document.querySelectorAll(".btn-decrease");

decreaseButtons.forEach(function (button) {
    button.addEventListener("click", function () {
        const quantityElement = button
            .closest(".quantity-group")
            .querySelector("#quantity");
        const currentQuantity = parseInt(quantityElement.innerText);
        if (currentQuantity > 0) {
            let quantity = currentQuantity - 1;
            quantityElement.innerText = quantity;
            updateCartTotal();
        }
    });
});

const increaseButtons = document.querySelectorAll(".btn-increase");

increaseButtons.forEach(function (button) {
    button.addEventListener("click", function () {
        const quantityElement = button
            .closest(".quantity-group")
            .querySelector("#quantity");
        const currentQuantity = parseInt(quantityElement.innerText);
        let quantity = currentQuantity + 1;
        quantityElement.innerText = quantity;
        updateCartTotal();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    updateCartTotal();
});
