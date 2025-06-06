renderCartItems();

function openNav() {
    document.getElementById("slide-menu").style.left = "0px";
}

function closeNav() {
    document.getElementById("slide-menu").style.left = "-500px";
}

function openCart() {
    console.log("Opening cart..."); // Debugging message
    const cartPanel = document.getElementById("shopping-cart");
    if (cartPanel) {
        cartPanel.style.display = "block"; // Make sure it's visible
        cartPanel.style.right = "0px";
    } else {
        console.error("Cart panel not found!");
    }
}

function closeCart() {
    document.getElementById("shopping-cart").style.right = "-550px";
}

function selectAllDot() {
    const headDot = document.getElementById("head-dot");
    const productDots = document.querySelectorAll(".product-dot");

    const isSelected = headDot.style.backgroundColor === "black";
    const newColor = isSelected ? "#D9D9D9" : "black";

    headDot.style.backgroundColor = newColor;

    productDots.forEach(dot => {
        dot.style.backgroundColor = newColor;
    });
}

function selectDot(dot) {
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

function changepayment() {
    document.getElementById("mod").disabled = false;
}

function changepayment() {
    document.getElementById("mod").disabled = false;
}

function openpayment() {
    const choice = document.getElementById("mod").value;

    const paymentChoice = document.getElementById("payment-choice");
    const paymentSuccess = document.getElementById("payment-success");

    if (choice === "Credit Card" || choice === "Gcash") {
        if (paymentChoice) paymentChoice.style.opacity = "1";
    } else if (choice === "Cash on Delivery") {
        if (paymentSuccess) paymentSuccess.style.opacity = "1";
    }
}


function handlePayment() {
    console.log("handlePayment() called");

    function cleanPrice(value) {
        return value.replace(/[₱\s,]/g, '').trim();
    }

    const merchandiseText = document.getElementById("merchandisePrice")?.innerText || "0";
    const shippingText = document.getElementById("shippingPrice")?.innerText || "0";
    const totalText = document.getElementById("totalPrice")?.innerText || "0";

    const merchandise = cleanPrice(merchandiseText);
    const shipping = cleanPrice(shippingText);
    const total = cleanPrice(totalText);

    document.getElementById("merchandise_input").value = merchandise;
    document.getElementById("shipping_input").value = shipping;
    document.getElementById("total_input").value = total;

    const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
    document.getElementById("cartDataInput").value = JSON.stringify(cartItems);

    const paymentMethod = document.getElementById("mod")?.value || "Credit Card";

    console.log({
        merchandise, shipping, total, cartItems, paymentMethod
    });

    openpayment(paymentMethod);

    console.log("Submitting form");
    document.getElementById("orderForm").submit();

}




function closepayment() {
    document.getElementById("payment-success").style.opacity = "1";
    document.getElementById("payment-choice").style.opacity = "0";
}

function closeSuccess() {
    document.getElementById("payment-success").style.opacity = "0";
}

function enableEdit() {
    const editButton = document.getElementById("edit-button");
    const saveButton = document.getElementById("save-button");
    const cancelButton = document.getElementById("cancel-button");
    const inputFields = document.querySelectorAll(".input-field");

    editButton.style.display = "none";
    saveButton.style.display = "inline-flex";
    cancelButton.style.display = "inline-flex";

    inputFields.forEach((field) => {
        field.removeAttribute("readonly");
        field.classList.add("editable");
    });
}

function saveChanges() {
    const editButton = document.getElementById("edit-button");
    const saveButton = document.getElementById("save-button");
    const cancelButton = document.getElementById("cancel-button");
    const inputFields = document.querySelectorAll(".input-field");

    editButton.style.display = "inline-flex";
    saveButton.style.display = "none";
    cancelButton.style.display = "none";

    inputFields.forEach((field) => {
        field.setAttribute("readonly", true);
        field.classList.remove("editable");
    });
}

function cancelEdit() {
    const editButton = document.getElementById("edit-button");
    const saveButton = document.getElementById("save-button");
    const cancelButton = document.getElementById("cancel-button");
    const inputFields = document.querySelectorAll(".input-field");

    editButton.style.display = "inline-flex";
    saveButton.style.display = "none";
    cancelButton.style.display = "none";

    inputFields.forEach((field) => {
        field.setAttribute("readonly", true);
        field.classList.remove("editable");
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const leftBtn = document.querySelector('.scroll-left');
    const rightBtn = document.querySelector('.scroll-right');
    const scrollContainer = document.querySelector('.product-display-new');

    if (leftBtn && rightBtn && scrollContainer) {
        leftBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
        });
        rightBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const payNowBtn = document.getElementById("pay");
    if (payNowBtn) {
        payNowBtn.addEventListener("click", handlePayment);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    let total = 0;
    document.querySelectorAll('.order-panel td:nth-child(4) p').forEach(function (cell) {
        let value = parseFloat(cell.textContent.replace(/[₱,]/g, '').trim());
        if (!isNaN(value)) total += value;
    });

    let shipping = 99.00;
    let grandTotal = total + shipping;

    let merchElem = document.getElementById('merchandisePrice');
    if (merchElem) merchElem.textContent = '₱ ' + total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    document.querySelectorAll('#totalPrice').forEach(function (elem) {
        elem.textContent = '₱ ' + grandTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    });

    let shipElem = document.getElementById('shippingPrice');
    if (shipElem) shipElem.textContent = '₱ ' + shipping.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
});

document.addEventListener('DOMContentLoaded', function () {
    // Size selection logic
    let selectedSize = '';
    const sizeButtons = document.querySelectorAll('.size-btn');
    const selectedSizeInput = document.getElementById('selected-size');

    sizeButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            sizeButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedSize = this.dataset.size;
            if (selectedSizeInput) {
                selectedSizeInput.value = selectedSize;
            }
        });
    });

    // Quantity logic
    const amountSpan = document.getElementById('quantity-amount');
    const quantityInput = document.getElementById('quantity-input');
    const increaseBtn = document.querySelector('.increaseBtn');
    const decreaseBtn = document.querySelector('.decreaseBtn');

    if (increaseBtn && amountSpan && quantityInput) {
        increaseBtn.addEventListener('click', function () {
            let qty = parseInt(amountSpan.innerText);
            qty++;
            amountSpan.innerText = qty;
            quantityInput.value = qty;
        });
    }

    if (decreaseBtn && amountSpan && quantityInput) {
        decreaseBtn.addEventListener('click', function () {
            let qty = parseInt(amountSpan.innerText);
            if (qty > 1) qty--;
            amountSpan.innerText = qty;
            quantityInput.value = qty;
        });
    }
});

window.addToCart = function (button, event) {
    event.stopPropagation();
    console.log("Add to Cart clicked");

    const id = button.dataset.id;
    const name = button.dataset.name;
    const price = parseFloat(button.dataset.price);
    const image = button.dataset.image;
    const size = "Default";
    const quantity = 1;

    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    const existing = cart.find(item => item.id === id && item.size === size);
    if (existing) {
        existing.quantity += 1;
    } else {
        cart.push({ id, name, price, image, size, quantity });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    renderCartItems();
    openCart();
}

function deleteSelectedItems() {
    const rows = document.querySelectorAll(".cart-row");
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const updatedCart = [];

    const selectedIds = [];

    rows.forEach(row => {
        const dot = row.querySelector(".product-dot");
        const isSelected = dot && dot.style.backgroundColor === "black";

        if (isSelected) {
            selectedIds.push(row.dataset.id);
            row.remove(); // remove visually
        }
    });

    cart.forEach(item => {
        const id = `${item.name}-${item.size}`;
        if (!selectedIds.includes(id)) {
            updatedCart.push(item);
        }
    });

    localStorage.setItem('cart', JSON.stringify(updatedCart));
    renderCartItems();
}

function updateQuantity(itemId, delta, event) {
    event.stopPropagation(); // Prevent navigation or parent event bubbling

    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const updatedCart = cart.map(item => {
        const id = `${item.name}-${item.size}`;
        if (id === itemId) {
            item.quantity += delta;
            if (item.quantity < 1) item.quantity = 1;
        }
        return item;
    });

    localStorage.setItem('cart', JSON.stringify(updatedCart));
    renderCartItems(); // Re-render cart UI
}


// Render cart items from localStorage into the #cart-items table
function renderCartItems() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItems = document.getElementById('cart-items');
    if (!cartItems) return;

    cartItems.innerHTML = '';
    cart.forEach(item => {
        const total = item.price * item.quantity;

        // Generate unique ID for tracking
        const itemId = `${item.name}-${item.size}`;

        const row = document.createElement('tr');
        row.className = 'cart-row';
        row.dataset.id = itemId; // Store unique ID here

        row.innerHTML = `
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="vertical-align: middle;">
                <!-- Product Column -->
                <td style="width: 80%; padding: 10px;">
                    <hr style="width: 100%; border: 1px solid #ccc; margin-bottom: 8px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <!-- Dot -->
                        <span class="product-dot" onclick="selectDot(this)"
                            style="cursor: pointer; height: 10px; width: 18px; border-radius: 50%; display: inline-block; border: 2px solid black; background-color: #D9D9D9;">
                        </span>

                        <!-- Product Image -->
                        <img src="${item.image}" alt="Product Image" style="width: 60px; height: 60px; object-fit: contain;">

                        <!-- Info and Quantity -->
                        <div style="display: flex; flex-direction: column; gap: 4px; width: 100%;">
                            <a href="/description/${item.id}?size=${item.size}&quantity=${item.quantity}">
                                <div class="product-info" onclick="goToProductDetails(${item.id})" style="cursor: pointer;">
                                    <h4 style="font-size: 15px; margin: 0; text-decoration: none; color: black;"">${item.name}</h4>
                                    <p style="margin: 0;">Size: ${item.size}</p>
                                </div>
                            </a>

                            <!-- Quantity Controls -->
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <button onclick="updateQuantity('${itemId}', -1, event)"
                                    style="width: 24px; height: 24px; font-size: 16px; border: none; background: #ccc; border-radius: 4px; cursor: pointer;">−</button>
                                <span id="qty-${itemId}" style="min-width: 24px; text-align: center;">${item.quantity}</span>
                                <button onclick="updateQuantity('${itemId}', 1, event)"
                                    style="width: 24px; height: 24px; font-size: 16px; border: none; background: #ccc; border-radius: 4px; cursor: pointer;">+</button>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- Price Column -->
                <td style="width: 20%; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                        <span style="font-weight: bold;">₱</span>
                        <span>${total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
                    </div>
                </td>
            </tr>
        </table>
    `;
        cartItems.appendChild(row);
    });
}

function goToProductDetails(productId) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const product = cart.find(item => item.id === productId);
    if (product) {
        // Store product in localStorage or sessionStorage
        localStorage.setItem('selectedProduct', JSON.stringify(product));
        window.location.href = '/product-description'; // Replace with your actual route
    }
}
