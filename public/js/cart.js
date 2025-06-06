document.addEventListener('DOMContentLoaded', function () {
    renderCartItems();
});

// Get and Save Cart
function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Render Cart Items
function renderCartItems() {
    const cart = getCart();
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';

    if (cart.length === 0) {
        cartItems.innerHTML = '<tr><td colspan="3">Your cart is empty.</td></tr>';
        return;
    }

    cart.forEach((item, index) => {
        const total = item.price * item.quantity;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <hr width="160%" size="2">
                <div style="margin-top: 5px; display: flex; align-items: center; gap: 10px;">
                    <span class="product-dot" style="cursor: pointer; height: 10px; width: 10px; border-radius: 50%; display: inline-block; border: black solid 2px; vertical-align: middle; background-color: #D9D9D9;"></span>
                    <img src="${item.image}" alt="Product Image" style="width: 60px; height: 70%; vertical-align: middle;">
                        <div class="product-info" style="cursor: pointer;">
                            <a href="/description/${item.id}?size=${item.size}&quantity=${item.quantity}" style="text-decoration: none; color: black;">
                                <h4 class="item-name" style="font-size: 20px; margin-top: 5px;">${item.name}</h4>
                                <p style="margin-top: -5px;">Size: ${item.size}</p>
                            </a>
                            <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                                <button type="button" class="qty-decrease" data-id="${item.id}">−</button>
                                <span id="qty-${item.id}" style="min-width: 24px; text-align: center;">${item.quantity}</span>
                                <button type="button" class="qty-increase" data-id="${item.id}">+</button>
                            </div>
                        </div>
                </div>
            </td>
            <td style="margin-left: 65px; margin-top: 60px; text-align: center;">
                <p>₱<span>${total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>
</p>
            </td>
        `;

        cartItems.appendChild(row);
    });

    // Bind events AFTER items are rendered
    document.querySelectorAll('.qty-increase').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            updateQuantity(id, 1);
        });
    });

    document.querySelectorAll('.qty-decrease').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            updateQuantity(id, -1);
        });
    });

    document.querySelectorAll('.product-dot').forEach(dot => {
        dot.addEventListener('click', function () {
            const currentColor = this.style.backgroundColor;
            this.style.backgroundColor = currentColor === "black" ? "#D9D9D9" : "black";
        });
    });
}


// Remove from cart
function removeCartItem(index) {
    let cart = getCart();
    cart.splice(index, 1);
    saveCart(cart);
    renderCartItems();
}

function updateQuantity(itemId, change) {
    let cart = getCart();
    let item = cart.find(i => i.id === itemId);

    if (!item) return;

    // Prevent quantity from going below 1
    if (item.quantity === 1 && change === -1) return;

    item.quantity += change;
    saveCart(cart);
    renderCartItems();
}

function deleteSelectedItems() {
    let cart = getCart();

    // Filter out items that have a black background dot (i.e., selected)
    const cartItems = document.querySelectorAll('#cart-items tr');
    let updatedCart = [];

    cartItems.forEach((row, index) => {
        const dot = row.querySelector('.product-dot');
        if (dot && dot.style.backgroundColor !== "black") {
            updatedCart.push(cart[index]);
        }
    });

    saveCart(updatedCart);
    renderCartItems();
}