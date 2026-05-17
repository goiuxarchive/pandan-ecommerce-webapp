<?php
require_once '../config/db.php';
include '../includes/header.php';

$cart_items = [
    [
        'id' => 1,
        'name' => 'Pandan Bags',
        'seller' => 'Luisiana Weavers Co-op',
        'price' => 150,
        'quantity' => 2,
        'image' => 'pandan_basket.jpeg',
        'category' => 'Handicrafts'
    ],
    [
        'id' => 2,
        'name' => 'Pandan Mats (Banig)',
        'seller' => 'Luisiana Heritage Weavers',
        'price' => 180,
        'quantity' => 1,
        'image' => 'pandan_woven.jpg',
        'category' => 'Handicrafts'
    ],
    [
        'id' => 3,
        'name' => 'Fresh Pandan Leaves',
        'seller' => 'Luisiana Organic Farm',
        'price' => 50,
        'quantity' => 3,
        'image' => 'fresh_pandan_leaves.jpeg',
        'category' => 'Fresh Leaves'
    ],
];

$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = 50;
$total = $subtotal + $shipping;
?>

<section class="cart-hero">
    <div class="container">
        <div class="cart-hero-content">
            <h1 class="cart-hero-title">
                <i class="fas fa-shopping-cart"></i> Your Cart
            </h1>
            <p class="cart-hero-subtitle">
                <?php echo count($cart_items); ?> items in your cart
            </p>
        </div>
        <div class="cart-breadcrumb">
            <a href="<?php echo $base_url; ?>/pages/products.php">Products</a>
            <i class="fas fa-chevron-right"></i>
            <span class="active">Cart</span>
            <i class="fas fa-chevron-right"></i>
            <span>Checkout</span>
        </div>
    </div>
</section>

<section class="cart-section">
    <div class="container">

        <?php if (empty($cart_items)): ?>
        <div class="cart-empty">
            <div class="cart-empty-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h2>Your cart is empty</h2>
            <p>Looks like you haven't added any products yet.</p>
            <a href="<?php echo $base_url; ?>/pages/products.php" class="btn btn-green">
                <i class="fas fa-arrow-left"></i> Browse Products
            </a>
        </div>

        <?php else: ?>
        <div class="cart-layout">

            <div class="cart-items-section">

                <div class="cart-items-header">
                    <h2 class="cart-items-title">Shopping Cart</h2>
                    <button class="btn-clear-cart" onclick="clearCart()">
                        <i class="fas fa-trash"></i> Clear Cart
                    </button>
                </div>

                <div class="cart-items-list" id="cartItemsList">
                    <?php foreach ($cart_items as $index => $item): ?>
                    <div class="cart-item fade-in" id="cartItem<?php echo $item['id']; ?>">

                        <div class="cart-item-img">
                            <img src="<?php echo $base_url; ?>/assets/images/<?php echo $item['image']; ?>"
                                 alt="<?php echo htmlspecialchars($item['name']); ?>">
                        </div>

                        <div class="cart-item-info">
                            <p class="cart-item-category"><?php echo htmlspecialchars($item['category']); ?></p>
                            <h3 class="cart-item-name"><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p class="cart-item-seller">
                                <i class="fas fa-store"></i>
                                <?php echo htmlspecialchars($item['seller']); ?>
                            </p>
                        </div>

                        <div class="cart-item-quantity">
                            <button class="qty-btn" onclick="updateQty(<?php echo $item['id']; ?>, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="qty-value" id="qty<?php echo $item['id']; ?>">
                                <?php echo $item['quantity']; ?>
                            </span>
                            <button class="qty-btn" onclick="updateQty(<?php echo $item['id']; ?>, 1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <div class="cart-item-price">
                            <p class="cart-item-unit-price">₱<?php echo number_format($item['price'], 2); ?> each</p>
                            <p class="cart-item-total-price" id="itemTotal<?php echo $item['id']; ?>">
                                ₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                            </p>
                        </div>

                        <button class="cart-item-remove" onclick="removeItem(<?php echo $item['id']; ?>)"
                                title="Remove item">
                            <i class="fas fa-times"></i>
                        </button>

                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-continue">
                    <a href="<?php echo $base_url; ?>/pages/products.php" class="btn-continue">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>

            </div>

            <div class="cart-summary">

                <div class="cart-summary-card">
                    <h3 class="cart-summary-title">Order Summary</h3>

                    <div class="cart-summary-details">
                        <div class="summary-row">
                            <span>Subtotal (<span id="itemCount"><?php echo count($cart_items); ?></span> items)</span>
                            <span id="summarySubtotal">₱<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping Fee</span>
                            <span>₱<?php echo number_format($shipping, 2); ?></span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span id="summaryTotal">₱<?php echo number_format($total, 2); ?></span>
                        </div>
                    </div>

                    <div class="delivery-notice">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Delivery Notice</strong>
                            <p>Available within Luisiana, Laguna barangays only</p>
                        </div>
                    </div>

                    <a href="<?php echo $base_url; ?>/cart/checkout.php" class="btn-checkout">
                        <i class="fas fa-lock"></i> Proceed to Checkout
                    </a>

                    <div class="payment-methods">
                        <p class="payment-methods-title">We Accept:</p>
                        <div class="payment-icons">
                            <div class="payment-icon">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Cash on Delivery</span>
                            </div>
                            <div class="payment-icon">
                                <i class="fas fa-mobile-alt"></i>
                                <span>GCash</span>
                            </div>
                            <div class="payment-icon">
                                <i class="fas fa-university"></i>
                                <span>Bank Transfer</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="promo-card">
                    <h4 class="promo-title">
                        <i class="fas fa-tag"></i> Promo Code
                    </h4>
                    <div class="promo-input-wrap">
                        <input type="text" id="promoCode" placeholder="Enter promo code...">
                        <button onclick="applyPromo()">Apply</button>
                    </div>
                    <p class="promo-message" id="promoMessage"></p>
                </div>

            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<style>

.cart-hero {
    background: linear-gradient(135deg, #155d34 0%, #1a6b3c 100%);
    padding: 40px 0;
}

.cart-hero-content {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 12px;
}

.cart-hero-title {
    font-size: 2rem;
    font-weight: 800;
    color: white;
    display: flex;
    align-items: center;
    gap: 12px;
}

.cart-hero-subtitle {
    font-size: 14px;
    color: rgba(255,255,255,0.7);
}

.cart-breadcrumb {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: rgba(255,255,255,0.6);
}

.cart-breadcrumb a {
    color: rgba(255,255,255,0.7);
    transition: var(--transition);
}

.cart-breadcrumb a:hover { color: white; }
.cart-breadcrumb .active { color: white; font-weight: 600; }
.cart-breadcrumb i { font-size: 10px; }

.cart-section {
    padding: 48px 0 80px;
    background: var(--bg-light);
}

.cart-empty {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.cart-empty-icon {
    font-size: 60px;
    color: var(--text-light);
    margin-bottom: 20px;
}

.cart-empty h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.cart-empty p {
    color: var(--text-gray);
    margin-bottom: 24px;
}

/* Cart Layout */
.cart-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 28px;
    align-items: start;
}

/* Cart Items Section */
.cart-items-section {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.cart-items-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
}

.cart-items-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
}

.btn-clear-cart {
    background: none;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 6px 14px;
    border-radius: 99px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: var(--transition);
}

.btn-clear-cart:hover {
    background: #fef2f2;
}

/* Cart Item */
.cart-item {
    display: grid;
    grid-template-columns: 80px 1fr auto auto auto;
    gap: 16px;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    transition: var(--transition);
}

.cart-item:hover {
    background: var(--bg-light);
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item-img {
    width: 80px;
    height: 80px;
    border-radius: var(--radius);
    overflow: hidden;
}

.cart-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-item-category {
    font-size: 11px;
    font-weight: 600;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
}

.cart-item-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
}

.cart-item-seller {
    font-size: 12px;
    color: var(--text-gray);
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Quantity Controls */
.cart-item-quantity {
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--bg-light);
    border-radius: 99px;
    padding: 4px 6px;
}

.qty-btn {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: none;
    background: white;
    color: var(--text-dark);
    font-size: 11px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    box-shadow: var(--shadow);
}

.qty-btn:hover {
    background: var(--primary);
    color: white;
}

.qty-value {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    min-width: 24px;
    text-align: center;
}

/* Price */
.cart-item-unit-price {
    font-size: 12px;
    color: var(--text-gray);
    margin-bottom: 4px;
    text-align: right;
}

.cart-item-total-price {
    font-size: 16px;
    font-weight: 800;
    color: var(--primary);
    text-align: right;
}

/* Remove Button */
.cart-item-remove {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid var(--border);
    background: white;
    color: var(--text-light);
    font-size: 13px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.cart-item-remove:hover {
    background: #fef2f2;
    border-color: #fecaca;
    color: #dc2626;
}

/* Continue Shopping */
.cart-continue {
    padding: 20px 24px;
    border-top: 1px solid var(--border);
}

.btn-continue {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: var(--primary);
    transition: var(--transition);
}

.btn-continue:hover {
    gap: 12px;
}

/* Order Summary */
.cart-summary {
    display: flex;
    flex-direction: column;
    gap: 16px;
    position: sticky;
    top: 90px;
}

.cart-summary-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow);
}

.cart-summary-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
}

.cart-summary-details {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    color: var(--text-gray);
}

.summary-total {
    font-size: 16px;
    font-weight: 800;
    color: var(--text-dark);
    padding-top: 12px;
    border-top: 1px solid var(--border);
}

/* Delivery Notice */
.delivery-notice {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: #f0faf4;
    border: 1px solid #bbf7d0;
    border-radius: var(--radius);
    padding: 12px 14px;
    margin-bottom: 20px;
}

.delivery-notice i {
    color: var(--primary);
    font-size: 14px;
    margin-top: 2px;
    flex-shrink: 0;
}

.delivery-notice strong {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 2px;
}

.delivery-notice p {
    font-size: 12px;
    color: var(--text-gray);
}

/* Checkout Button */
.btn-checkout {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 14px;
    background: var(--primary);
    color: white;
    border-radius: 99px;
    font-size: 15px;
    font-weight: 700;
    transition: var(--transition);
    margin-bottom: 20px;
}

.btn-checkout:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(26,107,60,0.3);
}

/* Payment Methods */
.payment-methods-title {
    font-size: 12px;
    color: var(--text-gray);
    margin-bottom: 10px;
    text-align: center;
}

.payment-icons {
    display: flex;
    justify-content: center;
    gap: 16px;
}

.payment-icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    color: var(--text-gray);
}

.payment-icon i {
    font-size: 20px;
    color: var(--primary);
}

/* Promo Card */
.promo-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 20px 24px;
    box-shadow: var(--shadow);
}

.promo-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.promo-title i { color: var(--primary); }

.promo-input-wrap {
    display: flex;
    gap: 8px;
}

.promo-input-wrap input {
    flex: 1;
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    font-size: 13px;
    outline: none;
    font-family: var(--font-main);
    transition: var(--transition);
}

.promo-input-wrap input:focus {
    border-color: var(--primary);
}

.promo-input-wrap button {
    padding: 10px 16px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: var(--radius);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    font-family: var(--font-main);
}

.promo-input-wrap button:hover {
    background: var(--primary-dark);
}

.promo-message {
    font-size: 12px;
    margin-top: 8px;
    min-height: 16px;
}
</style>

<script>
const cartData = {
    <?php foreach ($cart_items as $item): ?>
    <?php echo $item['id']; ?>: {
        price: <?php echo $item['price']; ?>,
        qty: <?php echo $item['quantity']; ?>
    },
    <?php endforeach; ?>
};

const SHIPPING = <?php echo $shipping; ?>;

function updateQty(id, change) {
    const item = cartData[id];
    if (!item) return;

    item.qty += change;
    if (item.qty < 1) {
        removeItem(id);
        return;
    }

    document.getElementById('qty' + id).textContent = item.qty;
    document.getElementById('itemTotal' + id).textContent =
        '₱' + (item.price * item.qty).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    updateSummary();
}

function removeItem(id) {
    const el = document.getElementById('cartItem' + id);
    if (el) {
        el.style.opacity = '0';
        el.style.transform = 'translateX(20px)';
        el.style.transition = 'all 0.3s ease';
        setTimeout(() => {
            el.remove();
            delete cartData[id];
            updateSummary();
        }, 300);
    }
}

function clearCart() {
    if (confirm('Are you sure you want to clear your cart?')) {
        const items = document.querySelectorAll('.cart-item');
        items.forEach(item => item.remove());
        Object.keys(cartData).forEach(k => delete cartData[k]);
        updateSummary();

        document.getElementById('cartItemsList').innerHTML = `
            <div style="text-align:center; padding: 40px 20px; color: var(--text-gray);">
                <i class="fas fa-shopping-cart" style="font-size:40px; margin-bottom:12px; display:block; color: var(--text-light);"></i>
                Your cart is empty.
                <br><br>
                <a href="${window.location.origin}/pandan/pages/products.php" style="color: var(--primary); font-weight:600;">Browse Products</a>
            </div>`;
    }
}

function updateSummary() {
    let subtotal = 0;
    let count = 0;

    Object.values(cartData).forEach(item => {
        subtotal += item.price * item.qty;
        count++;
    });

    const total = subtotal + (count > 0 ? SHIPPING : 0);

    document.getElementById('summarySubtotal').textContent =
        '₱' + subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    document.getElementById('summaryTotal').textContent =
        '₱' + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    document.getElementById('itemCount').textContent = count;
}

function applyPromo() {
    const code = document.getElementById('promoCode').value.trim().toUpperCase();
    const msg  = document.getElementById('promoMessage');

    if (code === 'PANDAN10') {
        msg.textContent = '✅ Promo code applied! 10% discount.';
        msg.style.color = 'var(--primary)';
    } else if (code === '') {
        msg.textContent = 'Please enter a promo code.';
        msg.style.color = '#dc2626';
    } else {
        msg.textContent = '❌ Invalid promo code.';
        msg.style.color = '#dc2626';
    }
}
</script>

<?php include '../includes/footer.php'; ?>