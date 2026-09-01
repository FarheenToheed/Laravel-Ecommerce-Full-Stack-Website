<footer class="footer">
    <div class="footer-grid">

        <div class="footer-col">
            <h4>Contact Us</h4>
            <div class="footer-col-body">
                <div class="contact-item">
                    <i class="fa-regular fa-envelope"></i>
                    <span><a href="#">wecare@mystore.pk</a></span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <div>
                        <span>+92(0)42 323-882-45</span><br>
                        <span>+92(0)42 111-738-245</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-col">
            <h4>Customer Care</h4>
            <div class="footer-col-body">
                <a href="{{ route('faqs') }}">FAQs</a>
                <a href="{{ route('page.show','exchange-return') }}">Exchange & Return Policy</a>

                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Information</h4>
            <div class="footer-col-body">
                <a href="{{ route('page.show', 'about') }}">About Us</a>
                <a href="{{ route('page.show','privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('page.show','payments') }}">Payments</a>
                
                <a href="{{ route('blogs.index') }}">Blogs</a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Newsletter Signup</h4>
            <div class="footer-col-body">
                <p>Subscribe to our newsletter for exclusive updates</p>
                <div class="newsletter-form">
                    <input type="email" placeholder="Your email address">
                    <button type="button">Subscribe</button>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; Copyright {{ date('Y') }} Sapphire. All rights reserved.</p>
        <div class="payment-icons">

            <img src="{{ asset('web/assets/img/mastercard.webp') }}">

            <img src="{{ asset('web/assets/img/visa.png') }}">

            <img src="{{ asset('web/assets/img/jazzcash.png') }}">

            <img src="{{ asset('web/assets/img/easypaisa.png') }}">

        </div>
    </div>

    {{-- for wishlist --}}
    <div id="wishlist-message"></div>
</footer>