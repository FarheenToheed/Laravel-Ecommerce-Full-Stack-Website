{{-- AUTH DRAWER --}}
<div class="auth-drawer" id="authDrawer">

    <div class="auth-drawer-header">
        <h3 id="authDrawerTitle">ACCOUNT</h3>
        <button class="auth-drawer-close" onclick="toggleAuth()">&times;</button>
    </div>

    <div class="auth-drawer-body">

        {{-- Error Message --}}
        <div class="auth-error" id="authError" style="display:none;"></div>

        {{-- LOGIN FORM --}}
        <form id="loginForm" class="auth-form">
            @csrf
            <div class="auth-field">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>

            <div class="auth-field">
                <label>Password *</label>
                <input type="password" name="password" required>
            </div>

            <a href="#" class="auth-forgot">FORGOT PASSWORD?</a>

            <button type="submit" class="auth-btn">SIGN IN</button>
        </form>

        <p class="auth-switch-text">
            NEW TO {{ config('app.name') }}?
        </p>
        <button class="auth-btn auth-btn-outline" onclick="showRegisterForm()">CREATE ACCOUNT</button>

        {{-- REGISTER FORM (chhupa hua by default) --}}
        <form id="registerForm" class="auth-form" style="display:none;">
            @csrf

            <div class="auth-field">
                <label>First Name *</label>
                <input type="text" name="name" required>
            </div>

            <div class="auth-field">
                <label>Last Name *</label>
                <input type="text" name="lastname" required>
            </div>

            <div class="auth-field auth-field-phone">
                <label>Phone Number *</label>
                <div class="auth-phone-wrapper">
                    <span class="auth-phone-code">+92</span>
                    <input type="text" name="phoneno" required>
                </div>
            </div>

            <div class="auth-field auth-field-phone">
                <label>Alternate Phone Number</label>
                <div class="auth-phone-wrapper">
                    <span class="auth-phone-code">+92</span>
                    <input type="text" name="alt_phone">
                </div>
            </div>

            <div class="auth-field">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>

            <div class="auth-field">
                <label>Alternate Email Address</label>
                <input type="email" name="alt_email">
            </div>

            <div class="auth-field">
                <label>Password *</label>
                <input type="password" name="password" required>
            </div>

            <div class="auth-field">
                <label>Confirm Password *</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="auth-btn">REGISTER</button>
        </form>

        <p class="auth-switch-text" id="backToLoginText" style="display:none;">
            <a href="#" onclick="showLoginForm()">Already have an account? Login here</a>
        </p>

    </div>

</div>

<div class="auth-overlay" id="authOverlay" onclick="toggleAuth()"></div>