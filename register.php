<?php
require_once '../config/db.php';
include '../includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirm_password'] ?? '';
    $phone     = trim($_POST['phone'] ?? '');
    $address   = trim($_POST['address'] ?? '');
    $role      = $_POST['role'] ?? 'customer';

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        // This will be connected to database in Phase 5
        $success = 'Account created successfully! You can now log in.';
    }
}
?>

<!-- ========== AUTH HERO ========== -->
<section class="auth-hero">
    <div class="auth-hero-content">
        <div class="section-badge">
            <i class="fas fa-leaf"></i> Join Our Community
        </div>
        <h1 class="auth-hero-title">Create Your Account</h1>
        <p class="auth-hero-subtitle">
            Maging bahagi ng Pandàn — ang komunidad ng mga nagmamahal sa kultura ng Luisiana
        </p>
    </div>
</section>

<!-- ========== AUTH SECTION ========== -->
<section class="auth-section">
    <div class="auth-container">

        <!-- ===== LEFT INFO PANEL ===== -->
        <div class="auth-info-panel">
            <div class="auth-panel-logo">
                <div class="logo-icon">
                    <img src="<?php echo $base_url; ?>/assets/images/official_logo.png" alt="Pandàn Logo">
                </div>
                <div class="logo-text">
                    <span class="logo-name">Pandàn</span>
                    <span class="logo-tagline">Luisiana's Pride</span>
                </div>
            </div>

            <h2 class="auth-panel-title">Why join Pandàn?</h2>

            <ul class="auth-panel-features">
                <li>
                    <div class="auth-feature-icon icon-green">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div>
                        <strong>Shop Authentic Products</strong>
                        <span>Directly from verified local sellers in Luisiana</span>
                    </div>
                </li>
                <li>
                    <div class="auth-feature-icon icon-blue">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div>
                        <strong>Save to Wishlist</strong>
                        <span>Keep track of your favorite pandan items</span>
                    </div>
                </li>
                <li>
                    <div class="auth-feature-icon icon-orange">
                        <i class="fas fa-box"></i>
                    </div>
                    <div>
                        <strong>Track Your Orders</strong>
                        <span>Real-time updates on every purchase</span>
                    </div>
                </li>
                <li>
                    <div class="auth-feature-icon icon-green">
                        <i class="fas fa-store"></i>
                    </div>
                    <div>
                        <strong>Become a Seller</strong>
                        <span>Sell your pandan products to the community</span>
                    </div>
                </li>
            </ul>

            <!-- Delivery Notice -->
            <div class="auth-panel-notice">
                <i class="fas fa-map-marker-alt"></i>
                <p>
                    <strong>Delivery Notice:</strong> Currently delivering within
                    Luisiana, Laguna barangays only.
                </p>
            </div>

        </div>

        <!-- ===== RIGHT FORM CARD ===== -->
        <div class="auth-form-card">

            <div class="auth-form-header">
                <h2 class="auth-form-title">Create Account</h2>
                <p class="auth-form-subtitle">
                    Already have an account?
                    <a href="<?php echo $base_url; ?>/auth/login.php" class="auth-link">Sign in here</a>
                </p>
            </div>

            <?php if ($error): ?>
                <div class="auth-alert auth-alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="auth-alert auth-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" id="registerForm" novalidate>

                <!-- Account Type -->
                <div class="form-group">
                    <label><i class="fas fa-user-tag"></i> Account Type</label>
                    <div class="role-selector">
                        <label class="role-option <?php echo ($_POST['role'] ?? 'customer') === 'customer' ? 'selected' : ''; ?>">
                            <input type="radio" name="role" value="customer"
                                <?php echo ($_POST['role'] ?? 'customer') === 'customer' ? 'checked' : ''; ?>
                                onchange="selectRole(this)">
                            <div class="role-option-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <strong>Customer</strong>
                                <span>Browse & buy products</span>
                            </div>
                        </label>
                        <label class="role-option <?php echo ($_POST['role'] ?? '') === 'seller' ? 'selected' : ''; ?>">
                            <input type="radio" name="role" value="seller"
                                <?php echo ($_POST['role'] ?? '') === 'seller' ? 'checked' : ''; ?>
                                onchange="selectRole(this)">
                            <div class="role-option-icon seller-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <div>
                                <strong>Seller</strong>
                                <span>Sell pandan products</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Full Name -->
                <div class="form-group">
                    <label for="full_name">
                        <i class="fas fa-user"></i> Full Name <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" id="full_name" name="full_name"
                               value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>"
                               placeholder="Juan Dela Cruz" required>
                        <span class="input-icon"><i class="fas fa-user"></i></span>
                    </div>
                    <span class="field-error" id="nameError"></span>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email Address <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email"
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                               placeholder="juan@email.com" required>
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                    <span class="field-error" id="emailError"></span>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="phone">
                        <i class="fas fa-phone"></i> Phone Number
                        <span class="optional">(Optional)</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="tel" id="phone" name="phone"
                               value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                               placeholder="+63 9XX XXX XXXX">
                        <span class="input-icon"><i class="fas fa-phone"></i></span>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">
                        <i class="fas fa-map-marker-alt"></i> Address
                        <span class="optional">(Optional)</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" id="address" name="address"
                               value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>"
                               placeholder="Brgy. San Antonio, Luisiana, Laguna">
                        <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                    </div>
                </div>

                <!-- Password Row -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i> Password <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password"
                                   placeholder="Min. 6 characters" required>
                            <button type="button" class="toggle-password"
                                    onclick="togglePassword('password', 'toggleIcon1')"
                                    title="Show/Hide password">
                                <i class="fas fa-eye" id="toggleIcon1"></i>
                            </button>
                        </div>
                        <span class="field-error" id="passwordError"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">
                            <i class="fas fa-lock"></i> Confirm Password <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input type="password" id="confirm_password" name="confirm_password"
                                   placeholder="Re-enter password" required>
                            <button type="button" class="toggle-password"
                                    onclick="togglePassword('confirm_password', 'toggleIcon2')"
                                    title="Show/Hide password">
                                <i class="fas fa-eye" id="toggleIcon2"></i>
                            </button>
                        </div>
                        <span class="field-error" id="confirmError"></span>
                    </div>
                </div>

                <!-- Password Strength -->
                <div class="password-strength" id="passwordStrength" style="display:none;">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <span class="strength-label" id="strengthLabel"></span>
                </div>

                <!-- Terms -->
                <div class="form-group">
                    <label class="terms-checkbox">
                        <input type="checkbox" id="terms" name="terms" required>
                        <span>
                            I agree to the
                            <a href="#" class="auth-link">Terms of Service</a> and
                            <a href="#" class="auth-link">Privacy Policy</a>
                        </span>
                    </label>
                    <span class="field-error" id="termsError"></span>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-auth-submit" id="submitBtn">
                    <span class="btn-text">
                        <i class="fas fa-user-plus"></i> Create Account
                    </span>
                    <span class="btn-loading" style="display:none;">
                        <i class="fas fa-spinner fa-spin"></i> Creating account...
                    </span>
                </button>

            </form>

        </div>
    </div>
</section>

<style>
/* ===== REGISTER SPECIFIC STYLES ===== */

.auth-hero {
    position: relative;
    background: linear-gradient(135deg, rgba(21,93,52,0.93) 0%, rgba(26,107,60,0.90) 60%, rgba(13,74,40,0.95) 100%),
                url('<?php echo $base_url; ?>/assets/images/pandan_basket.jpeg') center/cover no-repeat;
    padding: 64px 0 52px;
    text-align: center;
    overflow: hidden;
}
.auth-hero::before {
    content: '';
    position: absolute;
    top: -40%; right: -5%;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(74,222,128,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.auth-hero-content { position: relative; z-index: 1; }
.auth-hero-title { font-size: 2.6rem; font-weight: 800; color: white; margin: 14px 0 10px; }
.auth-hero-subtitle { font-size: 1rem; color: rgba(255,255,255,0.78); max-width: 520px; margin: 0 auto; line-height: 1.7; }

.auth-section { background: var(--bg-light); padding: 60px 0 80px; }
.auth-container { max-width: 1060px; margin: 0 auto; padding: 0 2rem; display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; align-items: start; }

.auth-info-panel { background: linear-gradient(155deg, #155d34 0%, #1a6b3c 100%); border-radius: var(--radius-lg); padding: 36px 32px; color: white; position: sticky; top: 90px; }
.auth-panel-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 28px; }
.auth-panel-logo .logo-name { color: white; }
.auth-panel-logo .logo-tagline { color: rgba(255,255,255,0.6); }
.auth-panel-title { font-size: 1.4rem; font-weight: 800; color: white; line-height: 1.35; margin-bottom: 24px; }
.auth-panel-features { display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px; list-style: none; }
.auth-panel-features li { display: flex; align-items: center; gap: 14px; }
.auth-feature-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 15px; color: white; flex-shrink: 0; }
.auth-feature-icon.icon-green { background: rgba(255,255,255,0.18); }
.auth-feature-icon.icon-blue { background: rgba(59,130,246,0.4); }
.auth-feature-icon.icon-orange { background: rgba(249,115,22,0.4); }
.auth-panel-features li strong { display: block; font-size: 14px; font-weight: 700; color: white; margin-bottom: 2px; }
.auth-panel-features li span { font-size: 12px; color: rgba(255,255,255,0.62); }

.auth-panel-notice { background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: var(--radius); padding: 16px 18px; display: flex; gap: 12px; align-items: flex-start; }
.auth-panel-notice i { color: var(--primary-light); font-size: 16px; flex-shrink: 0; margin-top: 2px; }
.auth-panel-notice p { font-size: 13px; color: rgba(255,255,255,0.8); line-height: 1.6; }
.auth-panel-notice strong { color: white; }

.auth-form-card { background: white; border-radius: var(--radius-lg); padding: 40px 36px; box-shadow: var(--shadow); border: 1px solid var(--border); }
.auth-form-header { margin-bottom: 24px; }
.auth-form-title { font-size: 1.8rem; font-weight: 800; color: var(--text-dark); margin-bottom: 6px; }
.auth-form-subtitle { font-size: 14px; color: var(--text-gray); }
.auth-link { color: var(--primary); font-weight: 600; }
.auth-link:hover { text-decoration: underline; color: var(--primary-dark); }

.auth-alert { display: flex; align-items: center; gap: 10px; padding: 12px 16px; border-radius: var(--radius); font-size: 14px; font-weight: 500; margin-bottom: 20px; }
.auth-alert-error { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.auth-alert-success { background: #f0fdf4; color: var(--primary); border: 1px solid #bbf7d0; }

/* Role Selector */
.role-selector { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 8px; }
.role-option { display: flex; align-items: center; gap: 12px; padding: 14px 16px; border-radius: var(--radius); border: 2px solid var(--border); cursor: pointer; transition: var(--transition); background: var(--bg-light); }
.role-option input[type="radio"] { display: none; }
.role-option:hover { border-color: var(--primary); background: #f0faf4; }
.role-option.selected { border-color: var(--primary); background: #f0faf4; }
.role-option-icon { width: 40px; height: 40px; border-radius: 10px; background: #dcfce7; display: flex; align-items: center; justify-content: center; font-size: 16px; color: var(--primary); flex-shrink: 0; }
.seller-icon { background: #fef9c3; color: #ca8a04; }
.role-option strong { display: block; font-size: 14px; font-weight: 700; color: var(--text-dark); margin-bottom: 2px; }
.role-option span { font-size: 12px; color: var(--text-gray); }

/* Input Styles */
.input-wrapper { position: relative; }
.input-wrapper input { padding-right: 44px !important; }
.input-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-light); font-size: 14px; pointer-events: none; }
.toggle-password { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-light); font-size: 15px; padding: 4px; display: flex; align-items: center; transition: var(--transition); }
.toggle-password:hover { color: var(--primary); }

.required { color: #dc2626; font-size: 12px; }
.optional { color: var(--text-light); font-size: 12px; font-weight: 400; }
.field-error { display: block; color: #dc2626; font-size: 12px; margin-top: 5px; min-height: 16px; }

/* Password Strength */
.password-strength { margin-top: -12px; margin-bottom: 16px; display: flex; align-items: center; gap: 10px; }
.strength-bar { flex: 1; height: 6px; background: var(--border); border-radius: 99px; overflow: hidden; }
.strength-fill { height: 100%; border-radius: 99px; transition: all 0.3s ease; width: 0; }
.strength-label { font-size: 12px; font-weight: 600; min-width: 50px; }

/* Terms Checkbox */
.terms-checkbox { display: flex; align-items: flex-start; gap: 10px; font-size: 13px; color: var(--text-gray); cursor: pointer; line-height: 1.5; }
.terms-checkbox input { width: 16px; height: 16px; accent-color: var(--primary); cursor: pointer; margin-top: 2px; flex-shrink: 0; }

.btn-auth-submit { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 99px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: var(--transition); font-family: var(--font-main); }
.btn-auth-submit:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(26,107,60,0.3); }

@media (max-width: 768px) {
    .auth-container { grid-template-columns: 1fr; }
    .auth-info-panel { position: static; }
    .auth-form-card { padding: 28px 20px; }
    .role-selector { grid-template-columns: 1fr; }
    .form-row { grid-template-columns: 1fr; }
}
</style>

<script>
// ---- ROLE SELECTOR ----
function selectRole(radio) {
    document.querySelectorAll('.role-option').forEach(opt => opt.classList.remove('selected'));
    radio.closest('.role-option').classList.add('selected');
}

// ---- PASSWORD TOGGLE ----
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    icon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
}

// ---- PASSWORD STRENGTH ----
document.getElementById('password').addEventListener('input', function() {
    const val = this.value;
    const strengthDiv = document.getElementById('passwordStrength');
    const fill = document.getElementById('strengthFill');
    const label = document.getElementById('strengthLabel');

    if (val.length === 0) { strengthDiv.style.display = 'none'; return; }
    strengthDiv.style.display = 'flex';

    let strength = 0;
    if (val.length >= 6) strength++;
    if (val.length >= 10) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[0-9]/.test(val)) strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;

    const levels = [
        { width: '20%', color: '#dc2626', text: 'Weak' },
        { width: '40%', color: '#f97316', text: 'Fair' },
        { width: '60%', color: '#eab308', text: 'Good' },
        { width: '80%', color: '#22c55e', text: 'Strong' },
        { width: '100%', color: '#15803d', text: 'Very Strong' }
    ];

    const level = levels[Math.min(strength - 1, 4)];
    fill.style.width = level.width;
    fill.style.background = level.color;
    label.textContent = level.text;
    label.style.color = level.color;
});

// ---- FORM VALIDATION ----
document.getElementById('registerForm').addEventListener('submit', function(e) {
    let valid = true;

    const name     = document.getElementById('full_name');
    const email    = document.getElementById('email');
    const password = document.getElementById('password');
    const confirm  = document.getElementById('confirm_password');
    const terms    = document.getElementById('terms');

    // Clear errors
    ['nameError','emailError','passwordError','confirmError','termsError'].forEach(id => {
        document.getElementById(id).textContent = '';
    });
    [name, email, password, confirm].forEach(f => f.style.borderColor = '');

    // Validate name
    if (!name.value.trim()) {
        document.getElementById('nameError').textContent = 'Full name is required.';
        name.style.borderColor = '#dc2626';
        valid = false;
    }

    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        document.getElementById('emailError').textContent = 'Email is required.';
        email.style.borderColor = '#dc2626';
        valid = false;
    } else if (!emailRegex.test(email.value.trim())) {
        document.getElementById('emailError').textContent = 'Enter a valid email address.';
        email.style.borderColor = '#dc2626';
        valid = false;
    }

    // Validate password
    if (!password.value) {
        document.getElementById('passwordError').textContent = 'Password is required.';
        password.style.borderColor = '#dc2626';
        valid = false;
    } else if (password.value.length < 6) {
        document.getElementById('passwordError').textContent = 'Password must be at least 6 characters.';
        password.style.borderColor = '#dc2626';
        valid = false;
    }

    // Validate confirm password
    if (!confirm.value) {
        document.getElementById('confirmError').textContent = 'Please confirm your password.';
        confirm.style.borderColor = '#dc2626';
        valid = false;
    } else if (password.value !== confirm.value) {
        document.getElementById('confirmError').textContent = 'Passwords do not match.';
        confirm.style.borderColor = '#dc2626';
        valid = false;
    }

    // Validate terms
    if (!terms.checked) {
        document.getElementById('termsError').textContent = 'You must agree to the Terms of Service.';
        valid = false;
    }

    if (!valid) { e.preventDefault(); return; }

    // Loading state
    const btn  = document.getElementById('submitBtn');
    btn.querySelector('.btn-text').style.display = 'none';
    btn.querySelector('.btn-loading').style.display = 'flex';
    btn.disabled = true;
});

// Clear errors on input
['full_name','email','password','confirm_password'].forEach(function(id) {
    document.getElementById(id).addEventListener('input', function() {
        this.style.borderColor = '';
        const errId = id === 'full_name' ? 'nameError' :
                      id === 'confirm_password' ? 'confirmError' : id + 'Error';
        document.getElementById(errId).textContent = '';
    });
});
</script>

<?php include '../includes/footer.php'; ?>