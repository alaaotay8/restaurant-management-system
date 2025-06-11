// api.js

// Example login function
async function login(email, password) {
    const response = await fetch('http://your-laravel-app-url/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password })
    });

    const data = await response.json();
    if (data.access_token) {
        localStorage.setItem('access_token', data.access_token);
    } else {
        console.error('Login failed');
    }
}


