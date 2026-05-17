<?php include '../includes/header.php'; ?>

<section class="contact-hero">
    <div class="container">
        <div class="section-badge" style="background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.2);">
            <i class="fas fa-envelope"></i> Get In Touch
        </div>
        <h1 class="contact-hero-title">Contact Us</h1>
        <p class="contact-hero-subtitle">
            May katanungan, mungkahi, o gustong malaman pa? 
            Huwag mag-atubiling makipag-ugnayan sa amin!
        </p>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">

            <div class="contact-info fade-in">

                <h2 class="contact-info-title">Contact Us</h2>
                <p class="contact-info-desc">
                    Kami ay laging handang tumulong sa inyo. Maaari kayong makipag-ugnayan 
                    sa amin sa pamamagitan ng iba't ibang paraan.
                </p>

                <div class="contact-cards">

                    <div class="contact-card">
                        <div class="contact-card-icon" style="background: #dcfce7;">
                            <i class="fas fa-map-marker-alt" style="color: var(--primary);"></i>
                        </div>
                        <div>
                            <h4>LOCATION</h4>
                            <p>Luisiana, Laguna<br>Philippines 4032</p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon" style="background: #dbeafe;">
                            <i class="fas fa-envelope" style="color: var(--accent-blue);"></i>
                        </div>
                        <div>
                            <h4>EMAIL ADDRESS</h4>
                            <p>dirkjohnstevencallos@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon" style="background: #dcfce7;">
                            <i class="fas fa-phone" style="color: var(--primary);"></i>
                        </div>
                        <div>
                            <h4>TELEPHONE</h4>
                            <p>0969 237 4953</p>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon" style="background: #fef9c3;">
                            <i class="fas fa-clock" style="color: #ca8a04;"></i>
                        </div>
                        <div>
                            <h4>OPERATING HOURS</h4>
                            <p>Monday - Saturday<br>8:00 AM - 5:00 PM</p>
                        </div>
                    </div>

                </div>

                <div class="contact-socials">
                    <h4 class="contact-socials-title">Follow Us:</h4>
                    <div class="contact-social-links">
                        <a href="#" class="contact-social-btn">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="contact-social-btn">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="contact-social-btn">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="contact-form-wrap fade-in">
                <div class="contact-form-card">
                    <h2 class="contact-form-title">Send a Message</h2>
                    <p class="contact-form-subtitle">
                        Punan ang form sa ibaba at kami ay makikipag-ugnayan sa inyo sa lalong madaling panahon.
                    </p>

                    <form class="contact-form" onsubmit="submitContactForm(event)">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">
                                    <i class="fas fa-user"></i>First Name
                                </label>
                                <input type="text" id="firstName" name="firstName">
                            </div>
                            <div class="form-group">
                                <label for="lastName">
                                    <i class="fas fa-user"></i>Last Name
                                </label>
                                <input type="text" id="lastName" name="lastName">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i>Email Address
                            </label>
                            <input type="email" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="phone">
                                <i class="fas fa-phone"></i>Contact Number (Optional)
                            </label>
                            <input type="tel" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="subject">
                                <i class="fas fa-tag"></i> Subject
                            </label>
                            <select id="subject" name="subject" required>
                                <option value="" disabled selected>Choose the Subject...</option>
                                <option value="order">Order Inquiry</option>
                                <option value="product">Product Question</option>
                                <option value="seller">Seller Inquiry</option>
                                <option value="delivery">Delivery Concern</option>
                                <option value="feedback">Feedback & Suggestions</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">
                                <i class="fas fa-comment"></i>Message
                            </label>
                            <textarea id="message" name="message" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn-contact-submit">
                            <i class="fas fa-paper-plane"></i>Send
                        </button>

                    </form>

                    <div class="contact-success" id="contactSuccess" style="display: none;">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>Salamat sa inyong mensahe!</h3>
                        <p>Natanggap na namin ang inyong mensahe. Makikipag-ugnayan kami sa inyo sa lalong madaling panahon.</p>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<script>
function submitContactForm(e) {
    e.preventDefault();

    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const email = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value.trim();

    if (!firstName || !lastName || !email || !subject || !message) {
        alert('Pakipunan ang lahat ng kinakailangang fields!');
        return;
    }

    document.querySelector('.contact-form').style.display = 'none';
    document.getElementById('contactSuccess').style.display = 'block';

    document.getElementById('contactSuccess').scrollIntoView({ behavior: 'smooth' });
}
</script>

<?php include '../includes/footer.php'; ?>