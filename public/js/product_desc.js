document.addEventListener('DOMContentLoaded', function () {
    setupSizeButtons();
    setupQuantityButtons();
    handleBuyNowValidation();
    autoFillFromParams();
    setupAddToCart();
    renderCartItems();
});

// Navigation functions
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

// Dot selection
function selectAllDot() {
    const dot1 = document.getElementById("head-dot");
    const dot2 = document.getElementById("product-dot");
    const currentColor = dot1.style.backgroundColor;
    const newColor = currentColor === "black" ? "#D9D9D9" : "black";
    dot1.style.backgroundColor = newColor;
    dot2.style.backgroundColor = newColor;
}
function selectDot(dot) {
    const currentColor = dot.style.backgroundColor;
    dot.style.backgroundColor = currentColor === "black" ? "#D9D9D9" : "black";
}

// Quantity controls
function setupQuantityButtons() {
    const amountSpan = document.getElementById('quantity-amount');
    const quantityInput = document.getElementById('quantity-input');

    document.querySelector('.increaseBtn').addEventListener('click', () => {
        let qty = parseInt(amountSpan.innerText);
        qty++;
        amountSpan.innerText = qty;
        quantityInput.value = qty;
    });

    document.querySelector('.decreaseBtn').addEventListener('click', () => {
        let qty = parseInt(amountSpan.innerText);
        if (qty > 1) qty--;
        amountSpan.innerText = qty;
        quantityInput.value = qty;
    });
}

// Size selection
function setupSizeButtons() {
    document.querySelectorAll('.size-btn, .size-buttons button').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.size-btn, .size-buttons button').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('selected-size').value = this.dataset.size;
        });
    });
}

// Form validation
function handleBuyNowValidation() {
    document.getElementById('buy-now-form').addEventListener('submit', function (e) {
        if (!document.getElementById('selected-size').value) {
            alert('Please select a size.');
            e.preventDefault();
        }
    });
}

// Auto-fill from URL query or Blade
function autoFillFromParams() {
    const params = new URLSearchParams(window.location.search);
    const selectedSize = params.get('size') || "{{ $selectedSize ?? '' }}";
    const selectedQty = parseInt(params.get('quantity') || "{{ $selectedQuantity ?? 1 }}");

    if (selectedSize) {
        document.querySelectorAll('.size-btn, .size-buttons button').forEach(btn => {
            if (btn.dataset.size === selectedSize) {
                btn.classList.add('active');
                document.getElementById('selected-size').value = selectedSize;
            }
        });
    }

    if (!isNaN(selectedQty) && selectedQty > 0) {
        document.getElementById('quantity-amount').innerText = selectedQty;
        document.getElementById('quantity-input').value = selectedQty;
    }
}

// Add to Cart
function setupAddToCart() {
    document.querySelector('.add-to-cart-btn').addEventListener('click', function (e) {
        e.preventDefault();

        const id = this.dataset.id;
        const name = this.dataset.name;
        const price = parseFloat(this.dataset.price);
        const image = this.dataset.image;
        const size = document.getElementById('selected-size').value;
        const quantity = parseInt(document.getElementById('quantity-input').value);

        if (!size) {
            alert('Please select a size before adding to cart.');
            return;
        }

        let cart = getCart();
        const existingItem = cart.find(item => item.id === id && item.size === size);

        if (existingItem) {
            existingItem.quantity = quantity;
        } else {
            cart.push({ id, name, price, image, size, quantity });
        }

        saveCart(cart);
        openCart();
        renderCartItems();
    });
}