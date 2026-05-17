const fadeElements = document.querySelectorAll('.fade-in');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, {
    threshold: 0.1
});

fadeElements.forEach(element => {
    observer.observe(element);
});

const navbar = document.querySelector('.navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
    } else {
        navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
    }
});

document.querySelectorAll('.product-wishlist').forEach(btn => {
    btn.addEventListener('click', function() {
        this.style.color = this.style.color === 'red' ? '' : 'red';
    });
});

document.querySelectorAll('.btn-add-cart').forEach(btn => {
    btn.addEventListener('click', function() {
        const original = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check"></i> Added!';
        this.style.background = '#155d34';
        setTimeout(() => {
            this.innerHTML = original;
            this.style.background = '';
        }, 1500);
    });
});