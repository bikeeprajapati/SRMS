document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const messageEl = document.getElementById('message');
    
    // Demo credentials (in a real app, this would be handled server-side)
    if (username === 'admin' && password === 'password123') {
      messageEl.textContent = 'Login successful!';
      messageEl.className = 'message success';
      
      // Animate the form away
      document.querySelector('.login-container').style.animation = 'fadeOut 0.5s ease-out forwards';
      
      // Redirect after animation (in a real app, this would go to an admin dashboard)
      setTimeout(() => {
        messageEl.textContent = 'Welcome to the admin panel!';
      }, 500);
    } else {
      messageEl.textContent = 'Invalid username or password';
      messageEl.className = 'message error';
      
      // Shake animation for error
      const form = document.querySelector('.login-form');
      form.style.animation = 'shake 0.5s ease-out';
      setTimeout(() => form.style.animation = '', 500);
    }
  });
  
  // Add these keyframe animations to handle the shake effect
  const style = document.createElement('style');
  style.textContent = `
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-10px); }
      75% { transform: translateX(10px); }
    }
    
    @keyframes fadeOut {
      to {
        opacity: 0;
        transform: translateY(-20px);
      }
    }
  `;
  document.head.appendChild(style);