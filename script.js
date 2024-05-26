// Script for navigation bar
























// Script for navigation bar*/

document.getElementById('login-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, password })
        });

        if (!response.ok) {
            throw new Error('Invalid username or password');
        }

        window.location.href = '/dashboard.html'; // Redirect to dashboard upon successful login
    } catch (error) {
        document.getElementById('error-message').textContent = error.message;
    }
});
