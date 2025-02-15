
        // Mobile Menu Toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');

        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Form Submission Handler
        function handleSubmit(e) {
            e.preventDefault();
            const loginBtn = document.getElementById('loginBtn');
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const usernameError = document.getElementById('usernameError');
            const passwordError = document.getElementById('passwordError');

            // Reset error messages
            usernameError.classList.remove('active');
            passwordError.classList.remove('active');

            // Basic validation
            let hasError = false;
            if (!username) {
                usernameError.classList.add('active');
                hasError = true;
            }
            if (!password) {
                passwordError.classList.add('active');
                hasError = true;
            }

            if (hasError) return;

            // Show loading state
            loginBtn.classList.add('loading');

            // Simulate API call (replace with actual authentication)
            setTimeout(() => {
                loginBtn.classList.remove('loading');
                
                // Add your authentication logic here
                // For demo purposes, using hardcoded credentials
                if (username === 'admin' && password === 'admin123') {
                    window.location.href = 'admin-dashboard.html';
                } else {
                    usernameError.textContent = 'Invalid username or password';
                    usernameError.classList.add('active');
                }
            }, 2000);
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.nav-container')) {
                navLinks.classList.remove('active');
            }
        });
    