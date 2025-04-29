
        // Mobile Menu Toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');

        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Form Submission Handler
        function handleSubmit(event) {
            event.preventDefault();
            
            // Get form values
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Reset error messages
            document.getElementById('usernameError').style.display = 'none';
            document.getElementById('passwordError').style.display = 'none';
            
            // Validate form
            let isValid = true;
            
            if (!username) {
                document.getElementById('usernameError').style.display = 'block';
                isValid = false;
            }
            
            if (!password) {
                document.getElementById('passwordError').style.display = 'block';
                isValid = false;
            }
            
            // If form is valid, submit to server
            if (isValid) {
                // Create a form to submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'admin_auth.php';
                
                // Add username field
                const usernameField = document.createElement('input');
                usernameField.type = 'hidden';
                usernameField.name = 'username';
                usernameField.value = username;
                form.appendChild(usernameField);
                
                // Add password field
                const passwordField = document.createElement('input');
                passwordField.type = 'hidden';
                passwordField.name = 'password';
                passwordField.value = password;
                form.appendChild(passwordField);
                
                // Append form to body and submit
                document.body.appendChild(form);
                form.submit();
            }
        }