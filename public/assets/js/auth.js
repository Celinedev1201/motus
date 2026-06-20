const registerForm = document.getElementById("register-form");
const loginForm = document.getElementById("login-form");

if (registerForm) {
  registerForm.onsubmit = async function (event) {
    event.preventDefault();

    const formData = new FormData(registerForm);

    const response = await fetch("/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        pseudo: formData.get("pseudo"),
        email: formData.get("email"),
        password: formData.get("password"),
      }),
    });

    const data = await response.json();

    document.getElementById("register-message").textContent = data.message;

    if (data.success) {
      setTimeout(() => {
        window.location.href = "/login";
      }, 1000);
    }
  };
}

if (loginForm) {
  loginForm.onsubmit = async function (event) {
    event.preventDefault();

    const formData = new FormData(loginForm);

    const response = await fetch("/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email: formData.get("email"),
        password: formData.get("password"),
      }),
    });

    const data = await response.json();

    document.getElementById("login-message").textContent = data.message;

    if (data.success) {
      window.location.href = "/game";
    }
  };
}
