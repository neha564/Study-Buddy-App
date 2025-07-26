document.getElementById('register-form').addEventListener('submit', async function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    const response = await fetch('http://localhost:3000/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    });

    const data = await response.json();

    if (response.ok) {
        // Show success message or redirect to login
        document.getElementById('success-message').innerText = 'Registration successful! You can now log in.';
        document.getElementById('error-message').innerText = ''; // Clear any previous error
    } else {
        // Show error message
        document.getElementById('error-message').innerText = data.message;
        document.getElementById('success-message').innerText = ''; // Clear any previous success message
    }
});
