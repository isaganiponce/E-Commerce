document.addEventListener('DOMContentLoaded', function () {
    setupSizeButtons();
    setupQuantityButtons();
    handleBuyNowValidation();
    autoFillFromParams();
    setupAddToCart();
    renderCartItems();
});

function openNav() {
    document.getElementById("slide-menu").style.left = "0px";
}

function closeNav() {
    document.getElementById("slide-menu").style.left = "-500px";
}

function openCart() {
    document.getElementById("shopping-cart").style.right = "0px";
}

function closeCart() {
    document.getElementById("shopping-cart").style.right = "-550px";
}

function selectAllDot() {
    const dot1 = document.getElementById("head-dot");
    const dot2 = document.getElementById("product-dot");
    const currentColor = dot1.style.backgroundColor;

    const newColor = currentColor === "black" ? "#D9D9D9" : "black";
    dot1.style.backgroundColor = newColor;
    dot2.style.backgroundColor = newColor;
}

function selectDot() {
    const dot = document.getElementById("product-dot");
    const currentColor = dot.style.backgroundColor;

    dot.style.backgroundColor = currentColor === "black" ? "#D9D9D9" : "black";
}

let unitPrice = null;

function increaseBtn() {
    const amount = document.getElementById("amount");
    const totalAmount = document.getElementById('price');

    let counter = parseInt(amount.innerText);
    const currentTotal = parseFloat(totalAmount.innerText);

    if (unitPrice === null && counter > 0) {
        unitPrice = currentTotal / counter;
    }

    counter++;
    amount.innerText = counter;
    totalAmount.innerText = (counter * unitPrice).toFixed(2);
}

function decreaseBtn() {
    const amount = document.getElementById("amount");
    const totalAmount = document.getElementById('price');

    let counter = parseInt(amount.innerText);
    const currentTotal = parseFloat(totalAmount.innerText);

    if (unitPrice === null && counter > 0) {
        unitPrice = currentTotal / counter;
    }

    if (counter > 0) {
        counter--;
        amount.innerText = counter;
    }

    totalAmount.innerText = (counter * unitPrice).toFixed(2);
}