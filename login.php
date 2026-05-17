<?php
require_once '../config/db.php';
include '../includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $error = 'Invalid email or password. Please try again.';
    }
}
?>

<section class="auth-hero">
    <div class="auth-hero-content">
        <div class="section-badge">
            <i class="fas fa-leaf"></i> Welcome Back!
        </div>
        <h1 class="auth-hero-title">Sign in to Pandàn</h1>
    </div>
</section>

<section class="auth-section">
    <div class="auth-container">

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

            <h2 class="auth-panel-title">Your gateway to authentic Pandan products</h2>

            <ul class="auth-panel-features">
                <li>
                    <div class="auth-feature-icon icon-green"><i class="fas fa-shopping-basket"></i></div>
                    <div>
                        <strong>Shop Authentic Products</strong>
                        <span>Directly from verified local sellers</span>
                    </div>
                </li>
                <li>
                    <div class="auth-feature-icon icon-blue"><i class="fas fa-heart"></i></div>
                    <div>
                        <strong>Save to Wishlist</strong>
                        <span>Keep track of your favorite items</span>
                    </div>
                </li>
                <li>
                    <div class="auth-feature-icon icon-orange"><i class="fas fa-box"></i></div>
                    <div>
                        <strong>Track Your Orders</strong>
                        <span>Real-time updates on every purchase</span>
                    </div>
                </li>
            </ul>

        </div>

        <div class="auth-form-card">

            <div class="auth-form-header">
                <h2 class="auth-form-title">Sign In</h2>
                <p class="auth-form-subtitle">
                    Don't have an account?
                    <a href="<?php echo $base_url; ?>/auth/register.php" class="auth-link">Create one here</a>
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

            <form method="POST" action="" id="loginForm" novalidate>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>Email Address
                    </label>
                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                            required
                            autocomplete="email"
                        >
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    </div>
                    <span class="field-error" id="emailError"></span>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()" title="Show/Hide password">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <span class="field-error" id="passwordError"></span>
                </div>

                <div class="auth-form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember">
                        Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-auth-submit" id="submitBtn">
                    <span class="btn-text"><i class="fas fa-sign-in-alt"></i> Sign In</span>
                    <span class="btn-loading" style="display:none;"><i class="fas fa-spinner fa-spin"></i> Signing in...</span>
                </button>

            </form>

            <div class="auth-divider">
                <span>or continue as</span>
            </div>

            <div class="auth-role-links">
                <a href="<?php echo $base_url; ?>/auth/seller_registration.php" class="role-link role-link-seller">
                    <i class="fas fa-store"></i>
                    <div>
                        <strong>Become a Seller</strong>
                        <span>Register your pandan business</span>
                    </div>
                    <i class="fas fa-arrow-right role-arrow"></i>
                </a>
            </div>

            <p class="auth-terms">
                By signing in, you agree to our
                <a href="#" class="auth-link">Terms of Service</a> and
                <a href="#" class="auth-link">Privacy Policy</a>.
            </p>

        </div>
    </div>
</section>

<style>

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
    top: -40%;
    right: -5%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(74,222,128,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.auth-hero-content { position: relative; z-index: 1; }
.auth-hero-title { font-size: 2.6rem; font-weight: 800; color: white; margin: 14px 0 10px; line-height: 1.2; }
.auth-hero-title span { color: var(--primary-light); }
.auth-hero-subtitle { font-size: 1rem; color: rgba(255,255,255,0.78); max-width: 520px; margin: 0 auto; line-height: 1.7; }

.auth-section { background: var(--bg-light); padding: 60px 0 80px; }
.auth-container { max-width: 1060px; margin: 0 auto; padding: 0 2rem; display: grid; grid-template-columns: 1fr 1.1fr; gap: 40px; align-items: start; }

.auth-info-panel { background: linear-gradient(155deg, #155d34 0%, #1a6b3c 100%); border-radius: var(--radius-lg); padding: 36px 32px; color: white; position: sticky; top: 90px; }
.auth-panel-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 28px; }
.auth-panel-logo .logo-name { color: white; }
.auth-panel-logo .logo-tagline { color: rgba(255,255,255,0.6); }
.auth-panel-title { font-size: 1.4rem; font-weight: 800; color: white; line-height: 1.35; margin-bottom: 12px; }
.auth-panel-desc { font-size: 14px; color: rgba(255,255,255,0.72); line-height: 1.7; margin-bottom: 28px; }
.auth-panel-features { display: flex; flex-direction: column; gap: 16px; margin-bottom: 28px; list-style: none; }
.auth-panel-features li { display: flex; align-items: center; gap: 14px; }
.auth-feature-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 15px; color: white; flex-shrink: 0; }
.auth-feature-icon.icon-green  { background: rgba(255,255,255,0.18); }
.auth-feature-icon.icon-blue   { background: rgba(59,130,246,0.4); }
.auth-feature-icon.icon-orange { background: rgba(249,115,22,0.4); }
.auth-panel-features li strong { display: block; font-size: 14px; font-weight: 700; color: white; margin-bottom: 2px; }
.auth-panel-features li span { font-size: 12px; color: rgba(255,255,255,0.62); }
.auth-panel-quote { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.18); border-radius: var(--radius); padding: 18px 20px; display: flex; gap: 12px; align-items: flex-start; }
.auth-panel-quote i { color: var(--primary-light); font-size: 18px; flex-shrink: 0; margin-top: 2px; }
.auth-panel-quote p { font-size: 13px; color: rgba(255,255,255,0.8); line-height: 1.7; font-style: italic; }

.auth-form-card { background: white; border-radius: var(--radius-lg); padding: 40px 36px; box-shadow: var(--shadow); border: 1px solid var(--border); }
.auth-form-header { margin-bottom: 24px; }
.auth-form-title { font-size: 1.8rem; font-weight: 800; color: var(--text-dark); margin-bottom: 6px; }
.auth-form-subtitle { font-size: 14px; color: var(--text-gray); }
.auth-link { color: var(--primary); font-weight: 600; }
.auth-link:hover { color: var(--primary-dark); text-decoration: underline; }

.auth-alert { display: flex; align-items: center; gap: 10px; padding: 12px 16px; border-radius: var(--radius); font-size: 14px; font-weight: 500; margin-bottom: 20px; }
.auth-alert-error { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.auth-alert-success { background: #f0fdf4; color: var(--primary); border: 1px solid #bbf7d0; }

.input-wrapper { position: relative; }
.input-wrapper input { padding-right: 44px !important; }
.input-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-light); font-size: 14px; pointer-events: none; }
.toggle-password { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-light); font-size: 15px; padding: 4px; display: flex; align-items: center; transition: var(--transition); }
.toggle-password:hover { color: var(--primary); }
.field-error { display: block; color: #dc2626; font-size: 12px; margin-top: 5px; min-height: 16px; }

.auth-form-options { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.remember-me { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-gray); cursor: pointer; user-select: none; }
.remember-me input[type="checkbox"] { width: 15px; height: 15px; accent-color: var(--primary); cursor: pointer; }
.forgot-link { font-size: 13px; color: var(--primary); font-weight: 600; }
.forgot-link:hover { color: var(--primary-dark); text-decoration: underline; }

.btn-auth-submit { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 99px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: var(--transition); font-family: var(--font-main); margin-bottom: 24px; }
.btn-auth-submit:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(26,107,60,0.3); }
.btn-auth-submit:active { transform: translateY(0); }

.auth-divider { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; color: var(--text-light); font-size: 13px; }
.auth-divider::before, .auth-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

.auth-role-links { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
.role-link { display: flex; align-items: center; gap: 14px; padding: 14px 18px; border-radius: var(--radius); border: 1.5px solid var(--border); transition: var(--transition); background: var(--bg-light); }
.role-link:hover { border-color: var(--primary); background: #f0faf4; transform: translateX(4px); }
.role-link > i:first-child { font-size: 18px; width: 36px; height: 36px; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.role-link-seller > i:first-child { background: #dcfce7; color: var(--primary); }
.role-link div { flex: 1; }
.role-link strong { display: block; font-size: 14px; font-weight: 700; color: var(--text-dark); margin-bottom: 2px; }
.role-link span { font-size: 12px; color: var(--text-gray); }
.role-arrow { color: var(--text-light); font-size: 13px; transition: var(--transition); }
.role-link:hover .role-arrow { color: var(--primary); transform: translateX(3px); }

.auth-terms { font-size: 12px; color: var(--text-light); text-align: center; line-height: 1.6; }

@media (max-width: 768px) {
    .auth-container { grid-template-columns: 1fr; }
    .auth-info-panel { position: static; }
    .auth-form-card { padding: 28px 20px; }
    .auth-hero-title { font-size: 2rem; }
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon    = document.getElementById('toggleIcon');
    const isHidden      = passwordInput.type === 'password';
    passwordInput.type  = isHidden ? 'text' : 'password';
    toggleIcon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
}

document.getElementById('loginForm').addEventListener('submit', function (e) {
    let valid = true;
    const email    = document.getElementById('email');
    const password = document.getElementById('password');
    const emailErr = document.getElementById('emailError');
    const passErr  = document.getElementById('passwordError');

    emailErr.textContent = '';
    passErr.textContent  = '';
    email.style.borderColor    = '';
    password.style.borderColor = '';

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        emailErr.textContent    = 'Email is required.';
        email.style.borderColor = '#dc2626';
        valid = false;
    } else if (!emailRegex.test(email.value.trim())) {
        emailErr.textContent    = 'Enter a valid email address.';
        email.style.borderColor = '#dc2626';
        valid = false;
    }

    if (!password.value) {
        passErr.textContent        = 'Password is required.';
        password.style.borderColor = '#dc2626';
        valid = false;
    } else if (password.value.length < 6) {
        passErr.textContent        = 'Password must be at least 6 characters.';
        password.style.borderColor = '#dc2626';
        valid = false;
    }

    if (!valid) { e.preventDefault(); return; }

    const btn     = document.getElementById('submitBtn');
    const btnText = btn.querySelector('.btn-text');
    const btnLoad = btn.querySelector('.btn-loading');
    btnText.style.display = 'none';
    btnLoad.style.display = 'flex';
    btn.disabled = true;
});

['email', 'password'].forEach(function (id) {
    document.getElementById(id).addEventListener('input', function () {
        this.style.borderColor = '';
        document.getElementById(id + 'Error').textContent = '';
    });
});
</script>

<?php include '../includes/footer.php'; ?>