// register.js
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registerForm');

    const patterns = {
        fullname: /^[A-Za-z\s.'-]{2,60}$/,
        username: /^[a-zA-Z0-9._-]{3,20}$/,
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]{8,}$/
    };

    const messages = {
        fullname: {
            empty: "Full name is required",
            invalid: "Full name must be 2–60 characters (letters, spaces, ., ', - allowed)"
        },
        username: {
            empty: "Username is required",
            invalid: "Username must be 3–20 characters (letters, numbers, . _ - only)"
        },
        email: {
            empty: "Email is required",
            invalid: "Please enter a valid email address"
        },
        password: {
            empty: "Password is required",
            invalid: "Password must be at least 8 characters with uppercase, lowercase and a number"
        },
        confirmPassword: {
            empty: "Please confirm your password",
            mismatch: "Passwords do not match"
        }
    };

    function showError(fieldName, message) {
        const errorEl = document.getElementById(fieldName + 'Error');
        errorEl.textContent = message;
        errorEl.style.color = '#e74c3c';
    }

    function clearError(fieldName) {
        const errorEl = document.getElementById(fieldName + 'Error');
        errorEl.textContent = '';
    }

    function validateField(input) {
        const name = input.name;
        const value = input.value.trim();

        clearError(name);

        if (!value) {
            showError(name, messages[name]?.empty || "This field is required");
            return false;
        }

        if (name === 'confirmPassword') {
            const pw = document.getElementById('password').value;
            if (value !== pw) {
                showError(name, messages.confirmPassword.mismatch);
                return false;
            }
            return true;
        }

        if (patterns[name] && !patterns[name].test(value)) {
            showError(name, messages[name]?.invalid || "Invalid format");
            return false;
        }

        return true;
    }

    ['fullname', 'username', 'email', 'password', 'confirmPassword'].forEach(name => {
        const input = document.getElementById(name);
        if (input) {
            input.addEventListener('blur', () => validateField(input));
        }
    });

    document.getElementById('confirmPassword')?.addEventListener('input', function() {
        validateField(this);
    });

    document.getElementById('password')?.addEventListener('input', function() {
        const confirm = document.getElementById('confirmPassword');
        if (confirm.value) validateField(confirm);
    });

    form.addEventListener('submit', e => {
        let valid = true;

        ['fullname', 'username', 'email', 'password', 'confirmPassword'].forEach(name => {
            const input = document.getElementById(name);
            if (input && !validateField(input)) {
                valid = false;
            }
        });

        if (!valid) {
            e.preventDefault();
            const firstError = form.querySelector('small:not(:empty)');
            if (firstError) firstError.previousElementSibling?.focus();
        }
    });
});