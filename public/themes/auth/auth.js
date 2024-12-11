document.addEventListener("DOMContentLoaded", function () {
  const inputContainer = document.getElementById('input-container');
  const input = inputContainer.querySelector('input');
  const inputContainer2 = document.getElementById('input-container-2');
  const input2 = inputContainer2.querySelector('input');
  const passwordInput = document.getElementById('password-input');
  const emailInput = document.getElementById('email-input');
  const toggleIcon = document.getElementById('toggle-icon');
  const form = document.querySelector('form');
  const errorMessage = document.getElementById('error-message');
  const loginButton = document.getElementById("login-button")

  function updateButtonColor() {
    if (emailInput.value && passwordInput.value) {
      loginButton.style.backgroundColor = '#FE6B0C';
    } else {
      loginButton.style.backgroundColor = '#B6B6B6';
    }
  }
  emailInput.addEventListener('input', updateButtonColor);
  passwordInput.addEventListener('input', updateButtonColor);

  input.addEventListener('focus', function () {
    inputContainer.classList.add('border-blue-500');
  });

  input.addEventListener('blur', function () {
    inputContainer.classList.remove('border-blue-500');
  });

  input2.addEventListener('focus', function () {
    inputContainer2.classList.add('border-blue-500');
  });

  input2.addEventListener('blur', function () {
    inputContainer2.classList.remove('border-blue-500');
  });

  toggleIcon.addEventListener('click', function () {
    const isPasswordVisible = passwordInput.type === 'text';
    passwordInput.type = isPasswordVisible ? 'password' : 'text';
    toggleIcon.src = isPasswordVisible ? '/themes/dashboard/assets/eye-off.svg' : '/themes/dashboard/assets/eye.svg';
  })

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    const email = document.getElementById('email-input').value;
    const password = document.getElementById('password-input').value;
    if (!email || !password) {
      errorMessage.textContent = 'Email and password are required';
      return;
    }

    form.submit();
  });
});

