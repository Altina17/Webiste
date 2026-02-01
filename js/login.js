document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');

    const patterns = {
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        password: /^.{6,}$/
    };

    const messages = {
        email: {
            empty: "Email is required",
            invalid: "Please enter a valid email address"
        },
        password: {
            empty: "Password is required",
            invalid: "Password must be at least 6 characters"
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

        if (patterns[name] && !patterns[name].test(value)) {
            showError(name, messages[name]?.invalid || "Invalid format");
            return false;
        }

        return true;
    }

    ['email', 'password'].forEach(name => {
        const input = document.getElementById(name);
        if (input) {
            input.addEventListener('blur', () => validateField(input));
        }
    });

    document.getElementById('password')?.addEventListener('input', function() {
        validateField(this);
    });

    form.addEventListener('submit', e => {
        let isValid = true;

        ['email', 'password'].forEach(name => {
            const input = document.getElementById(name);
            if (input && !validateField(input)) {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            const firstError = form.querySelector('small:not(:empty)');
            if (firstError) firstError.previousElementSibling?.focus();
        }
    });
});